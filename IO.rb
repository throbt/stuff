

#@params = {
# :host => '192.168.1.102',
# :user => 'wiw_gen',
# :pssw => 'foci06vb',
# :db   => 'hirek_old'
#}

#begin
#  @db = Mysql.new(@params[:host], @params[:user], @params[:pssw], @params[:db])
#  @db.query("set names utf8")
#    rescue Mysql::Error
#    puts "cant connect to mysql"
#    exit
#end

#def fetchAll(resource)
#  arr = []
#  resource.each_hash do |row|
#    arr.push row
#  end
#  arr
#end

def rssRead(feed)
  FeedNormalizer::FeedNormalizer.parse open(feed)
end

#def rssRead(feed)
#  open(feed) do |s|
#    @content = s.read
#  end
#  RSS::Parser.parse(@content, false)
#end

def utf8(str)
  begin
    Iconv.conv('US-ASCII//IGNORE', 'UTF-8', str)
    rescue
  end
  str
end

def rssWrite(items, title)

  @title = title

  type = {
    "cimlap"          => "Címlap",
    "auto"            => "Autó",
    "belfolg"         => "Belföld",
    "bulvar"          => "Bulvár",
    "eletmod"         => "Életmód",
    "fooldal"         => "Főoldal",
    "gazdasag"        => "Gazdaság",
    "infotech"        => "Infotech",
    "itthon"          => "Itthon",
    "kulfold"         => "Külföld",
    "oktatas-kultura" => "Oktatás - Kultúra",
    "sport"           => "Sport",
    "tudomany"        => "Tudomány"
  }

  retype = {
    "Címlap"            => "cimlap",
    "Autó"              => "auto",
    "Belföld"           => "belfold",
    "Bulvár"            => "bulvar",
    "Életmód"           => "eletmod",
    "Főoldal"           => "fooldal",
    "Gazdaság"          => "gazdasag",
    "Infotech"          => "infotech",
    "Itthon"            => "itthon",
    "Külföld"           => "kulfold",
    "Oktatás - Kultúra" => "oktatas-kultura",
    "Sport"             => "sport",
    "Tudomány"          => "tudomany"
  }

  time      = Time.new
#   dst       = (time.dst? ? "+0200" : "+0100")
#   days      = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
#   months    = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec"]
#   @timeNow  = "#{days[time.wday]}, #{time.day} #{months[time.month]} #{time.year} #{time.hour}:#{time.min}:#{(time.sec.to_s.length == 1 ? '0' + time.sec.to_s : time.sec)} #{dst}"

  rss = RSS::Maker.make("2.0") do |maker|
    maker.channel.about       = "http://www.hirek.hu"
    maker.channel.title       = retype[@title] #type[@title]
    maker.channel.webMaster   = "webmester@hirek.hu (Webmester)"
    maker.channel.description = "Hirek.hu #{time.year}"
    maker.channel.link        = "http://www.hirek.hu/rss.php?page=#{title}"
    maker.channel.language    = "hu_HU"
    maker.channel.pubDate     = time

    items.each do |thisItem|
      maker.items.new_item do |item|
        item.link         = thisItem["link"]
        item.title        = thisItem["title"]
        item.description  = thisItem["description"]
        item.pubDate      = time
      end
    end
  end
  rss
end

def writeFile(file, content)
  File.open(file,"w") do |f|
    f.write(content)
  end
end

#def delete(filename)

#  puts filename

##  Dir["#{File.dirname(filename)}/*"].each do |file|
##    next if File.basename(file) == File.basename(filename)
##    FileUtils.rm_rf file #, :noop => true, :verbose => true
##  end
#end

def readFile(file)
  data = ''
  IO.readlines(file).each do |line|
    data += line
  end
  data
end

class String
  def removeHtmlGarbage
    self.removeNBSP.fixBadlatinOne.escapeHtmlEntities.gsub(/(<[^<>]+>)/, "").strip
  end

  def splitSproc
    self.split('{---separator---}')
  end

	def removeMarks
		str = self.to_s
		str = str.gsub(/\(/, " ")
		str = str.gsub(/\)/, " ")
		str = str.gsub(/\?/, " ")
		str = str.gsub(/\!/, " ")
		str = str.gsub(/\,/, " ")
		str = str.gsub(/\-/, " ")
		str = str.gsub(/\:/, " ")
		str = str.gsub(/\./, " ")
		str = str.gsub(/\'/, " ")
		str = str.gsub(/\"/, " ")
		str = str.gsub(/\\/, " ")
		str = str.gsub(/\//, " ")
		str = str.gsub(/\[/, " ")
		str = str.gsub(/\]/, " ")
		str = str.gsub(/\;/, " ")
		str
	end

  def removeHtmlContent(element)
    self.gsub(/(<#{element}.*#{element}>)/, "")
  end

  def removeGarbage
    str = self.to_s
    garbage = [":"]
    garbage.each do |item|
      str = str.gsub(/#{item}/, "")
    end
    str = str.gsub(/\n/, " ")
    str = str.gsub(/\r\n/, " ")
    str
  end

  def removeBracketContent
    str = self.to_s
    if(Regexp.new(/(\()/).match(str))
      str = str.gsub(/(\(.*\))/, " ")
    end
  str
  end

  # Hpricot bug - img.attributes["src"] doesnt work
  def getImageSource
    self.split('src="')[1].to_s.split('" ')[0]
  end

  def escapeHtmlEntities
    str = self.to_s
    str = HTMLEntities.new.decode(self)
    str
  end

  def removeNBSP
    str = self.to_s
    str = str.gsub(/&nbsp;/, " ")
    str
  end

	def removeSomeEntityShit
		str = self.to_s
    str = str.gsub(/&#8203;/, " ")
		str = str.gsub(/&#148;/, " ")
    str
	end

  def fixBadlatinOne
    str = self.to_s
    entities = {
    '&#x80;'=>'&#x20AC;', '&#x81;'=>'?',        '&#x82;'=>'&#x201A;', '&#x83;'=>'&#x0192;',
    '&#x84;'=>'&#x201E;', '&#x85;'=>'&#x2026;', '&#x86;'=>'&#x2020;', '&#x87;'=>'&#x2021;',
    '&#x88;'=>'&#x02C6;', '&#x89;'=>'&#x2030;', '&#x8A;'=>'&#x0160;', '&#x8B;'=>'&#x2039;',
    '&#x8C;'=>'&#x0152;', '&#x8D;'=>'?',        '&#x8E;'=>'&#x017D;', '&#x8F;'=>'?',
    '&#x90;'=>'?',        '&#x91;'=>'&#x2018;', '&#x92;'=>'&#x2019;', '&#x93;'=>'&#x201C;',
    '&#x94;'=>'&#x201D;', '&#x95;'=>'&#x2022;', '&#x96;'=>'&#x2013;', '&#x97;'=>'&#x2014;',
    '&#x98;'=>'&#x02DC;', '&#x99;'=>'&#x2122;', '&#x9A;'=>'&#x0161;', '&#x9B;'=>'&#x203A;',
    '&#x9C;'=>'&#x0153;', '&#x9D;'=>'?',        '&#x9E;'=>'&#x017E;', '&#x9F;'=>'&#x0178;'
    }
    entities.each do |k, v|
      str = str.gsub(/(#{k})/, v)
    end
    str
  end
end
