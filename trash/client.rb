#!/home/rcis/.rvm/rubies/ruby-1.9.3-p194/bin/ruby
# encoding: ascii

require "awesome_print"
require 'socket'
 
socket = TCPSocket.open("91.82.85.216", 8888)
socket.write([0x0a,0x00,0x01,0x12,0xa2,0xb8,0xc7,0x01,0x12,0xa2,0xb8,0xc7].pack('C*'))               # Send request

sleep 2

socket.write([0x05,0x00,0x01,0x12,0xa2,0xb8,0xc7].pack('C*'))

# ap socket.gets 

# loop {
#   ap socket.gets 
# }


while true
  ap socket.recv(1012)

  # if partial_data.length == 0
  #   break
  # end

  # all_data << partial_data
end


# require "bindata"
# require "awesome_print"
# require 'socket'

# @m = {
#   '0'   => [0x00,0x00].pack('C*'),
#   '1'   => [0x00,0x01].pack('C*'),
#   '2'   => [0x00,0x02].pack('C*'),
#   '3'   => [0x00,0x03].pack('C*'),
#   '4'   => [0x00,0x04].pack('C*'),
#   '5'   => [0x00,0x05].pack('C*'),
#   '6'   => [0x00,0x06].pack('C*'),
#   '7'   => [0x00,0x07].pack('C*'),
#   '8'   => [0x00,0x08].pack('C*'),
#   '9'   => [0x00,0x09].pack('C*'),
#   '10'  => [0x00,0x0A].pack('C*'),
#   '11'  => [0x00,0x0B].pack('C*'),
#   '12'  => [0x00,0x0C].pack('C*'),
#   '13'  => [0x00,0x0D].pack('C*'),
#   '14'  => [0x00,0x0E].pack('C*'),
#   '15'  => [0x00,0x0F].pack('C*'),
#   '242' => [0x00,0xF2].pack('C*')
# }

# #puts @m[ARGV[0]].unpack('C*')
# #exit

# @message = [0x00,0x01].pack('C*')

# client = TCPSocket.open("89.133.136.245", 8888)

# client.write @m[ARGV[0]] if @m[ARGV[0]] != nil

# client.close
