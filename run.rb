#!/home/rcis/.rvm/rubies/ruby-1.9.3-p194/bin/ruby
# encoding: utf-8

@path = '/home/rcis/rcis/'

require "awesome_print"
require 'celluloid/io'
require 'pg'
require "#{@path}cfg/cfg.rb"
require "#{@path}class/stuff.rb"
require "#{@path}class/processes.rb"
require "#{@path}model/messages.rb"
require "#{@path}class/postgres.rb"
require "#{@path}class/rcis.rb"

rcis = Rcis.new(@ip,@port,@frontend)
puts "Running, press enter to exit"
gets