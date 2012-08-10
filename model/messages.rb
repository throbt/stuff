
class Messages

  def initialize
    @messages = {
        'rcis' => {
        
          # 1   => 'OK',
          # 2   => 'UZENET HIBA JELZÉS',
          # 10  => 'INDÍTÁS JELZÉS',
          # 11  => 'LEÁLLÁS JELZÉS',
          # 12  => 'ÁLLAPOTJELENTÉS KÉRÉS',
          # 15  => 'RVM KÓDCSERE',
          # 16  => 'PARAMÉTER BEÁLLÍTÁS',
          # 18  => 'VONALKÓD FRISSÍTÉS',
          # 242 => 'RVM PARAMÉTER RESZETELÉS'
        },
        'rvm' => {
        
          1   => 'OK',
          2   => 'RVM_ERROR',           # rvm hiba jelzes
          11  => 'RVM_STATE',           # ÁLLAPOTJELENTÉS
          12  => 'RVM_REPORT',          # report
          14  => 'RVM_CONTAINER'        # container urites
        },
        
        'frontend' => {
        
          1   => 'ping'
        }
    }
  end

  def get(caller,id)
    @messages[caller][id] if @messages[caller][id] != nil
  end

end