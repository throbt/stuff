class Rcis

  include Celluloid::IO
  attr_accessor :rvms, :DEPO








  def initialize(ip,port,frontend)
    @port         = port
    @ip           = ip
    @frontend     = frontend
    @stuff        = Stuff.new
    @messager     = Messages.new
    @processes    = Processes.new(self)
    @rvms         = {}
    @server       = Celluloid::IO::TCPServer.new(ip, port)
    @DEPO         = []
    @listenerLock = 0

    messageListener
    run!
  end











  def messageListener

    # ez a voltakeppeni uzenet kuldo
    Thread.new {
      loop {

       #  @rvms['89.133.136.245'].to_io.write [
       #     0x01,0x00,0x01
       # ].pack('C*')

        if @listenerLock == 0

          @listenerLock = 1

          ### first of all we need to send the echo type (simple ok) messeages. collecting them
          echoes = @stuff.DEPO_lookup_by_type('echo',@DEPO)
          echoes.each do |_echo|
            
            puts 'rvms'
            ap _echo['ip']
            ap @rvms
            ap @DEPO

            ## sending message to rvm
            if @rvms[_echo['ip']] != nil
              @rvms[_echo['ip']].to_io.write _echo['message'].pack('C*')

              ### deleting the sended message
              @DEPO = @stuff.delete_from_DEPO_by_timestamp(_echo['generated'],@DEPO)
            else

              ## set failed status of the message
              @DEPO = @stuff.set_failed_status_by_timestamp(_echo['generated'],@DEPO)
            end

          end

          # puts 'after xxxxxxxxxx delete'
          # ap @DEPO

          @listenerLock = 0
        end
        sleep 2
      }
    }
  end








  def run
    puts " *** Starting main event loop."
    loop do
      handle! @server.accept
    end
  end







  def readMessage(arr)
    lengthLow     = arr[0].unpack('C*')[0]
    lengthHigh    = arr[1].unpack('C*')[0]
    absLength     = lengthHigh * 256 + lengthLow
    relLength     = absLength + 1                 # ugye!
    type          = arr[2].unpack('C*')[0]
    message       = []
    result        = {}

    ## validate
    if(absLength + 2 == arr.size)
      message     = []
      (2..relLength).step(1) do |i|
        message << arr[i].unpack('C*')[0]
      end
      result['type']    = type
      result['message'] = message
    else
      result['type']    = 'invalid'
      result['message'] = []
    end
    result
  end








  def handle(socket)

    _, port, host = socket.peeraddr
    _method = ''

    @rvms[host] = socket if @rvms[host] == nil

    puts " *** Starting socket listener loop for host: #{host}, port: #{port}"

    loop {
      res = readMessage(socket.readpartial(5000))

      if res['type'] != 'invalid'
        case host
          when @frontend
            _method  = @messager.get('frontend',res['type'])
          else
            _method  = @messager.get('rvm',res['type'])
        end

        if(_method != nil)
          @processes.send(_method,res['message'],host)      if @processes.respond_to?(_method)
        else
          puts "invalid method call(#{res['type']}) in message has detected from #{host}"
        end
      else
        puts "invalid message has detected from #{host}"
      end
    }

    rescue EOFError, Errno::ECONNRESET
    ensure
      client_disconnected(host)
  end






  def client_disconnected(host)
    puts "client disconnected #{host}"
    @rvms.delete host
  end

end

