#!/home/rcis/.rvm/rubies/ruby-1.9.3-p194/bin/ruby
# encoding: utf-8

@path     = '/home/v/Desktop/rcis/'
@dir      = '/home/v/Desktop/rcis/depo/'
@depo     = '/home/v/Desktop/rcis/DEPO/'

require 'awesome_print'
require 'celluloid/io'
require 'fileutils'
require 'pg'
require "#{@path}cfg.rb"
require "#{@path}postgres.rb"
require "#{@path}processes.rb"
require "#{@path}messages.rb"

class FileParser
  def initialize(dir,depo)
    @dir        = dir
    @depo       = depo
    @messager   = Messages.new
    @processes  = Processes.new
  end

  def getTime(thisTime)
    arr = thisTime.to_s.split(' ')[0].split('-')
    {
      'year'  => arr[0],
      'month' => arr[1],
      'day'   => arr[2]
    }
  end

  def readFile(file)
    data = ''
    IO.readlines(file).each do |line|
      data += line
    end
    data
  end

  def readMessage(arr)

    lengthLow     = arr[0].unpack('C*')[0]
    lengthHigh    = arr[1].unpack('C*')[0]
    length        = lengthHigh * 256 + lengthLow      + 1 # ugye!
    type          = arr[2].unpack('C*')[0]

    message     = []
    (2..length).step(1) do |i|
      message << arr[i].unpack('C*')[0]
    end

    {'type' => type,'message' => message}
  end

  def do
    Dir.entries(@dir).each do |file|
      parse(file) if file != '.' && file != '..'
    end 
  end

  def parse(file)
    timeArr     = getTime(Time.now)
    res         = readMessage readFile "#{@dir}#{file}"
    thisMethod  = @messager.get('rvm',res['type'])

    @processes.send(thisMethod,res['message']) if @processes.respond_to?(thisMethod)

    fileMove(file,timeArr)
  end

  def createDir(timeArr)
    currentDir = "#{@depo}#{timeArr['year']}"
    Dir.mkdir(currentDir,0777) if Dir[currentDir].length == 0
    currentDir = "#{@depo}#{timeArr['year']}/#{timeArr['month']}/"
    Dir.mkdir(currentDir,0777) if Dir[currentDir].length == 0
    currentDir = "#{@depo}#{timeArr['year']}/#{timeArr['month']}/#{timeArr['day']}/"
    Dir.mkdir(currentDir,0777) if Dir[currentDir].length == 0
  end

  def fileMove(file,timeArr)
    currentDir = "#{@depo}#{timeArr['year']}/#{timeArr['month']}/#{timeArr['day']}/"
    createDir(timeArr) if Dir[currentDir].length == 0

    `mv #{@dir}#{file} #{currentDir}#{file}`
  end
end

@fileParser = FileParser.new(@dir,@depo)

loop {
  @fileParser.do
  sleep 2
}
