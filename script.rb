#!/home/rcis/.rvm/rubies/ruby-1.9.3-p194/bin/ruby
# encoding: utf-8

@path = '/home/rcis/rcis/'
require "awesome_print"
require 'pg'
require "#{@path}cfg/cfg.rb"
require "#{@path}class/stuff.rb"
require "#{@path}class/postgres.rb"

@postgres = Postgres.new('rcis')

def insertIp
  res = @postgres.insert("
    insert into rvm.rvm
    (ip,retailer_unit_id,lat,lng,modifier,modified,serial_number,comment) values
    ( $1, $2, $3, $4, $5, $6, $7, $8) RETURNING id;
  ",["#{ARGV[2]}",11111,'49.12547','36.4579',15,'now()',17,'oke, sima ugy']);

  puts "rvm_id is: #{res[0]['id']}"
end

def die
  puts 'theres no given argument - exit'
  exit
end

def help
  puts 'script.rb {-h} help'
  puts 'script.rb {-i} insert {ip} [ip address]'
  exit
end

def insert
  case ARGV[1]
    when 'ip'
      puts "is it correct ip address: #{ARGV[2]} ?"
      puts "type y or n"
      inp = $stdin.gets  # looks like inp + \n
      if inp[0] == "y"
        insertIp
      end
    else
      puts 'wrong argument, type -h for help'
  end
  puts 'Exit'
  exit
end

die     if ARGV[0] == nil
help    if ARGV[0] == '-h'
insert  if ARGV[0] == '-i'

exit

# res = @postgres.insert("
#   insert
#     into
#       rvm.rvm
#   (ip,retailer_unit_id,lat,lng,modifier,modified,serial_number,comment)
#     values
#   ( $1, $2, $3, $4, $5, $6, $7, $8) RETURNING id;
# ",[
#   '89.133.136.289',
#   11111,
#   '49.12547',
#   '36.4579',
#   15,
#   'now()',
#   17,
#   'oke, sima ugy'
# ]);

# ap res

# res = @postgres.fetchAll("
#   insert
#     into
#       rvm.rvm
#   (ip,retailer_unit_id,lat,lng,modifier,modified,serial_number,comment)
#     values
#   ('89.133.136.251',11111,'49.12547','36.4579',15,now(),17,'oke, sima ugy') RETURNING id;
# ");

# ap res[0]['id']

# @postgres.query('delete from rvm.message_in where rvm_id = $1',[371]);


# res = @postgres.fetchAll("
#   select id from rvm.rvm where ip = $1
# ",['89.133.136.245'])

# ap res