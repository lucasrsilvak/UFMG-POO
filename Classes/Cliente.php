<?php
  class Cliente extends Pessoa {
    static string $local_filename = "Cliente.txt";

    public function __construct($Nome, $RG, $Email, $Telefone, $CPF) {
      parent::__construct($Nome, $RG, $Email, $Telefone, $CPF);

      Logger::logMessage($Nome, $this);
      $this->save();
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Nome",
          "RG",
          "Email",
          "Telefone",
          "CPF"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Nome,
          $this->RG,
          $this->Email,
          formatarTelefone($this->Telefone),
          formatarCPF($this->CPF)
        ];
      }
    }

    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>