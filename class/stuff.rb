class Stuff

  def dec2Hex(dec)
    [dec].pack('C*').unpack('H*')[0]
  end

  def dec2bin(dec)
    [dec].pack('C*').unpack('B*')[0]
  end

  def decArr2Hex(arr)
    res = []
    arr.each do |item| 
      res.push([item].pack('C*').unpack('H*'))
    end
    res
  end

  def decArr2bin(arr)
    res = ''
    arr.each do |item| 
      res += [item].pack('C*').unpack('B*')[0]
    end
    res
  end

  def dec2Byte(arr)
    arr.pack('C*')
  end

  def DEPO_lookup_by_type(type,_DEPO)
    res = []
    _DEPO.each do |messageItem|
      res.push messageItem if messageItem['type'] == type
    end
    res
  end

  def delete_from_DEPO_by_timestamp(timestamp,_DEPO)
    res = []
    _DEPO.each do |messageItem|
      res.push messageItem if messageItem['generated'] != timestamp
    end
    return res
  end

  def set_failed_status_by_timestamp(timestamp,_DEPO)
    res = []
    _DEPO.each do |messageItem|
      messageItem['status'] = 'failed' if messageItem['generated'] == timestamp
      res.push messageItem
    end
    return res
  end

  def DEPO_lookup_by_ip(type,_DEPO)
  end

end