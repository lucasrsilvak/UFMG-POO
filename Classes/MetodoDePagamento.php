<?php
  class MetodoDePagamento extends persist {
    static string $local_filename = "MetodoDePagamento.txt";

    protected string $Metodo;
    
    public function __construct($Metodo) {
      $this->Metodo = $Metodo;

      Logger::logMessage("Método de Pagamento " . $Metodo . " cadastrado com sucesso!", null);
      $this->save();
    }

    public function getMetodo() {
      return $this->Metodo;
    }

    public function setMetodo($Metodo) {
      $this->Metodo = $Metodo;
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class) {
        return [
          "Metodo"
        ];
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getAtributos($Class);
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class) {
        return [
          $this->Metodo
        ];   
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getDados($Class);
      }
    }

    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>