#!/home/vvv/.rvm/rubies/ruby-1.8.7-p334/bin/ruby

require "rubygems"
require "mysql"
require "pp"

@params = {
	:host => "localhost",
	:user => "root",
	:pssw => "v",
	:db		=> "maxima"
}

begin
	@db = Mysql.new(@params[:host], @params[:user], @params[:pssw], @params[:db])
	rescue Mysql::Error
		puts "cant connect to mysql"
		exit
end

@tablesNames    = []
@thisDir        = "/home/vvv/Desktop/maxima_sql/"
@schema         = {}
@table          = []


def getTableNames  
  Dir[@thisDir + "*.sql"].each do |file|
# 		if file.match(/(\/)(multigroup\.sql)/) || file.match(/(\/)(members\.sql)/) || file.match(/(\/)(groups\.sql)/) || file.match(/(\/)(multi_members\.sql)/) || file.match(/(\/)(multi\.sql)/)
#     	@tablesNames.push file.match(/(maxima_sql\/)(.*)(\.sql)/)[2]
# 		end
		
		if file.match(/(\/)(messages\.sql)/)
    	@tablesNames.push file.match(/(maxima_sql\/)(.*)(\.sql)/)[2]
		end

# 		@tablesNames.push file.match(/(maxima_sql\/)(.*)(\.sql)/)[2]
  end
end

def mysqlFetchAll(resource)
	arr = []
	resource.each_hash do |row|
		arr.push row
	end
	arr
end

# |\_____|\   |\_____|\		|\_____|\		|\_____|\		|\_____|\		|\_____|\		|\_____|\		|\_____|\		|\_____|\		|\_____|\		|\_____|\
#	|       0\	|       0\	|       0\	|       0\	|       0\	|       0\	|       0\	|       0\  |       0\	|       0\	|       0\
#	| A____  /	| A____  /	| A____  /	| A____  /	| A____  /	| A____  /	| A____  /	| A____  /	| A____  /	| A____  /	| A____  /
#	|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/		|/|/ |/\/

getTableNames

@tablesNames.each do |table| 
  query = 
    "SELECT 
	    COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE, IS_NULLABLE, COLUMN_DEFAULT
    FROM 
	    INFORMATION_SCHEMA.COLUMNS
    WHERE 
	    TABLE_NAME = '#{table}'
    ORDER BY 
	    ORDINAL_POSITION"
  @schema[table] = mysqlFetchAll @db.query query 
end

@schema.each_key do |key|
  @table.push(
    (@table.length == 0 ? "" : "\n"),
    "<table name=\"#{key}\" >\n"
  )
  @schema[key].each do |column|
    @table.push(
      	"\n",
      	"<row name=\"#{column["COLUMN_NAME"]}\">\n",
      	"<datatype>",
      	column["DATA_TYPE"],
      	"</datatype>\n",
#       	"<default>NULL</default>\n",
      	"</row>\n"
    )
  end
  @table.push(
# 			"\n<key type=\"PRIMARY\" name=\"\">\n",
# 			"\<part>id</part>\n",
# 	  	"\</key>\n",
		"\n</table>\n"
	)
end
   # x=\"100\" y=\"200\"
	 
# 	 puts @tablesNames.length
	 
puts "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<sql>
  <datatypes db=\"mysql\">
	  <group label=\"Numeric\" color=\"rgb(238,238,170)\">
		  <type label=\"Integer\" length=\"0\" sql=\"INTEGER\" re=\"INT\" quote=\"\"/>
		  <type label=\"Decimal\" length=\"1\" sql=\"DECIMAL\" re=\"DEC\" quote=\"\"/>
		  <type label=\"Single precision\" length=\"0\" sql=\"FLOAT\" quote=\"\"/>
		  <type label=\"Double precision\" length=\"0\" sql=\"DOUBLE\" re=\"DOUBLE\" quote=\"\"/>
	  </group>

	  <group label=\"Character\" color=\"rgb(255,200,200)\">
		  <type label=\"Char\" length=\"1\" sql=\"CHAR\" quote=\"'\"/>
		  <type label=\"Varchar\" length=\"1\" sql=\"VARCHAR\" quote=\"'\"/>
		  <type label=\"Text\" length=\"0\" sql=\"MEDIUMTEXT\" re=\"TEXT\" quote=\"'\"/>
		  <type label=\"Binary\" length=\"1\" sql=\"BINARY\" quote=\"'\"/>
		  <type label=\"Varbinary\" length=\"1\" sql=\"VARBINARY\" quote=\"'\"/>
		  <type label=\"BLOB\" length=\"0\" sql=\"BLOB\" re=\"BLOB\" quote=\"'\"/>
	  </group>

	  <group label=\"Date &amp; Time\" color=\"rgb(200,255,200)\">
		  <type label=\"Date\" length=\"0\" sql=\"DATE\" quote=\"'\"/>
		  <type label=\"Time\" length=\"0\" sql=\"TIME\" quote=\"'\"/>
		  <type label=\"Datetime\" length=\"0\" sql=\"DATETIME\" quote=\"'\"/>
		  <type label=\"Year\" length=\"0\" sql=\"YEAR\" quote=\"\"/>
		  <type label=\"Timestamp\" length=\"0\" sql=\"TIMESTAMP\" quote=\"'\"/>
	  </group>

	  <group label=\"Miscellaneous\" color=\"rgb(200,200,255)\">
		  <type label=\"ENUM\" length=\"1\" sql=\"ENUM\" quote=\"\"/>
		  <type label=\"SET\" length=\"1\" sql=\"SET\" quote=\"\"/>
		  <type label=\"Bit\" length=\"0\" sql=\"bit\" quote=\"\"/>
	  </group>
  </datatypes>
	#{@table.join("")}
</sql>
"
