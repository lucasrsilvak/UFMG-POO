<?php
  class Especialidade extends persist {
    static string $local_filename = "Especialidade.txt";
    
    protected string $Especialidade;
    protected float  $ValorPercentual;
    
    public function __construct($Especialidade, $ValorPercentual) {
      $this->Especialidade   = $Especialidade;
      $this->ValorPercentual = $ValorPercentual;

      Logger::logMessage($Especialidade, $this);
      $this->save();
    }

    // Getters
    public function getEspecialidade() {
      return $this->Especialidade;
    }
    public function getValorPercentual() {
      return $this->ValorPercentual;
    }

    // Setters
    public function setEspecialidade($Especialidade) {
      $this->Especialidade = $Especialidade;
    }
    public function setValorPercentual($ValorPercentual) {
      $this->ValorPercentual = $ValorPercentual;
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class) {
        return [
          "Especialidade",
          "Valor Percentual"
        ];
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getAtributos($Class);
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class) {
        return [
          $this->Especialidade,
          $this->ValorPercentual
        ];   
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getDados($Class);
      }
    }
    
    // Hooks
    static public function getFilename() {
      return get_called_class()::$local_filename;
    }
  }
?>