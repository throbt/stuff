class Postgres
  
  def initialize(db)
    begin
      # @db = PGconn.open(:dbname => db)
      @db = PG.connect(dbname: db)
        rescue PGError
          puts "cant connect to postgres"
          exit
    end
  end

  def query(query,arr)
    @db.prepare('statement1',query)
    begin
      @db.exec_prepared('statement1',arr)
      @db.exec("DEALLOCATE statement1;")
        rescue PGError
          puts "wrong query:  #{PGError.inspect}"
          exit
    end
  end

  def insert(query,arr)
    result = []
    @db.prepare('statement1',query)
    begin
      res = @db.exec_prepared('statement1',arr)
      @db.exec("DEALLOCATE statement1;")
        rescue PGError
          puts "wrong query:  #{PGError.inspect}"
          exit
    end
    if res != nil
      res.each do |record|
        result.push record
      end
      result
    end
  end

  def fetchAll(query,arr)
    result = []
    @db.prepare('statement1',query)
    begin
      res = @db.exec_prepared('statement1',arr)
      @db.exec("DEALLOCATE statement1;")
        rescue PGError
          puts "wrong query:  #{PGError.inspect}"
          exit
    end
    if res != nil
      res.each do |record|
        result.push record
      end
      result
    end
  end
end
