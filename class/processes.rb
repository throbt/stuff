class Processes

  def initialize(rcis)
    @postgres = Postgres.new('rcis')
    @rcis     = rcis
    @stuff    = Stuff.new
  end

  def SEND_OK_2_RVM(ip)
    @rcis.DEPO.push({
      'ip'        => ip,                # ip address
      'type'      => 'echo',            # {explicit, echo}
      'status'    => 'unsended',        # status {sended, unsended, failed} 
      'message'   => [0x01,0x00,0x01],  # simple OK
      'generated' => Time.now.to_i      # timestamp
    })

    # puts 'after insert'
    # ap @rcis.DEPO
  end

  def write_message_in(message,ip)
    rvm_id    = getRVM(ip)
    m_length  = message.length
    if(rvm_id && m_length > 0)
      m_type        = message[0]
      received      = 'now()'
      message_bytea = @stuff.dec2Byte message

      @postgres.query('
        insert
          into
            rvm.message_in
              (rvm_id,m_type,received,m_length,message)
            values
              ($1,$2,$3,$4,$5);
      ',[rvm_id,m_type,'now()',m_length,message_bytea])
    end
  end

  def write_message_out(message,ip)

    

    # puts getWrittenMessageID('in',371)

    rvm_id    = getRVM(ip)
    m_length  = message.length
    if(rvm_id && m_length > 0)
      m_type        = message[0]
      received      = 'now()'
      message_bytea = @stuff.dec2Byte message

      @postgres.query('
        insert
          into
            rvm.message_out
              (rvm_id,m_type,sent,m_length,message)
            values
              ($1,$2,$3,$4,$5);
      ',[rvm_id,m_type,'now()',m_length,message_bytea])  # RETURNING id
    end
  end

  def getRVM(ip)
    result = @postgres.fetchAll('select id from rvm.rvm where ip = $1',[ip])
    return result[0]['id'] if result[0]['id']
    return nil
  end

  def getWrittenMessageID(direction,rvm_id)
    case direction
      when 'in'
        id = @postgres.fetchAll('select id from rvm.message_in where rvm_id = $1 order by id desc limit 1;',[rvm_id])
      when 'out'
        id = @postgres.fetchAll('select id from rvm.message_out where rvm_id = $1 order by id desc limit 1;',[rvm_id])
    end
    return id[0]['id'] if id[0]['id'] != nil
    nil
  end

  def OK(message,ip)
  end

  def RVM_ERROR(message,ip)
  end

  def RVM_STATE(message,ip)

    # write_message_in(message,ip)

    SEND_OK_2_RVM(ip)

    messageParams = {
      'messStateCode'     => message[0],

      # table rvm.state
      # autoincrement value, csekkold, hogy unique e, ha nem ird felul a mar meglevot (a message_in tablaba mindenkeppen bekerul)
      'stateLow'          => message[1],
      'stateHigh'         => message[2],

      'year'              => @stuff.dec2Hex(message[3]),
      'month'             => @stuff.dec2Hex(message[4]),
      'day'               => @stuff.dec2Hex(message[5]),
      'hour'              => @stuff.dec2Hex(message[6]),
      'minute'            => @stuff.dec2Hex(message[7]),
      'second'            => @stuff.dec2Hex(message[8]),

      ## az aktualis telitettseg
      'containerLow'      => message[9],
      'containerHigh'     => message[10],

      ## mindegyiket kulon mezobe state1, state2, etc..
      'bit_states0_7'     => @stuff.dec2bin(message[11]), # boolean
      'bit_states8_15'    => @stuff.dec2bin(message[12]), # boolean
      'bit_states16_23'   => @stuff.dec2bin(message[13]), # boolean
      'bit_states24_31'   => @stuff.dec2bin(message[14]), # boolean


      ## 4 byte long big integer {integer}  1 + 2x256 + 3x256x256 + 4x256x256x256  <= az eddigi osszes palack az rvm eletciklusa szerint
      'all_bottles0_7'    => message[15], 
      'all_bottles8_15'   => message[16],
      'all_bottles16_23'  => message[17],
      'all_bottles24_31'  => message[18],

      # lofasz , 2 byteos szam
      'handlerLow'        => message[19],
      'handlerHigh'       => message[20]
    }

    ## szolni kell a thread.new - nak, hogy kuldjon egy ok-t

    # ap message
    # ap messageParams
    # ap message.size
    # ap messageParams.size

    # ap @rcis.rvms

    # @rcis.rvms["89.133.136.245"].to_io.write [
    #   0x01,0x00,0x01
    # ].pack('C*')

    # sleep 2

    # @rcis.rvms["89.133.136.245"].to_io.write [
    #   0x01,0x00,0x01
    # ].pack('C*')

    # @rcis.rvms.each do |key,rvm|

    #   ap key
    #   ap rvm

    #   rvm.write [
    #      0x01,0x00,0x01
    #  ].pack('C*')
    # end

    # @postgres.query(
    #   "
    #     insert
    #       into
    #         .....
    #   "
    # )
  end

  # minden rvm hasznalatnal(palack kerul bele) kuld egy ilyet az rvm
  def RVM_REPORT(message,ip)

    puts 'transactionReport'

    messageParams = {
      'stateCode'         => message[0],
      
      # rvm.transaction   + rvm.message_in
      ## tranzakcio azonosito, 4 byte integer 1 + 2x256 + 3x256x256 + 4x256x256x256
      'TR_0_7'            => message[1],
      'TR_8_15'           => message[2],
      'TR_16_23'          => message[3],
      'TR_24_31'          => message[4],

      'year'              => @stuff.dec2Hex(message[5]),
      'month'             => @stuff.dec2Hex(message[6]),
      'day'               => @stuff.dec2Hex(message[7]),
      'hour'              => @stuff.dec2Hex(message[8]),
      'minute'            => @stuff.dec2Hex(message[9]),
      'second'            => @stuff.dec2Hex(message[10]),

      ## eppen mennyi Ft ertekben kerult bele
      'sum_0_7'           => message[11],
      'sum_8_15'          => message[12],
      'sum_16_23'         => message[13],
      'sum_24_31'         => message[14],

       
      'destination'       => message[15], # decimal, indiffi

      'barcodeLow'        => message[16], # decimal, indiffi , 2 byte int low
      'barcodeHigh'       => message[17], # decimal, indiffi , 2 byte int high

      ## hany darab palack kerult bele
      'pieces'            => message[18], # decimal, byte

      # palack  egysegar ( pieces X  price => sum(4 byte int) nem kell csekkolni, kb) 
      'priceLow'          => message[19],
      'priceHigh'         => message[20]
    }

    ap message
    ap messageParams

  end

  def RVM_CONTAINER(message,ip)

    puts 'containerEmptying'

    messageParams = {
      'stateCode'         => message[0],

      'year'              => @stuff.dec2Hex(message[1]),
      'month'             => @stuff.dec2Hex(message[2]),
      'day'               => @stuff.dec2Hex(message[3]),
      'hour'              => @stuff.dec2Hex(message[4]),
      'minute'            => @stuff.dec2Hex(message[5]),
      'second'            => @stuff.dec2Hex(message[6]),

      # hany darab palack lett uritve a containerbol, 2 byteint
      'containerLow'      => message[7],
      'containerHigh'     => message[8]
    }

    ap message
    ap messageParams

  end

  def ping(ip)
    ap @rcis
  end

  
end