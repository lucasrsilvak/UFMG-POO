<?php
  class Pessoa extends persist {
    static string $local_filename = "Pessoa.txt";

    protected ?string $CPF;
    protected string $Email;
    protected string $Nome;
    protected string $RG;
    protected int    $Telefone;

    public function __construct($Nome, $RG, $Email, $Telefone, $CPF = null) {
      if (isset($CPF) && !self::validaCPF($CPF)) {
        throw new Exception('CPF Inválido!');
      }
      $this->Nome     = $Nome;
      $this->RG       = $RG;
      $this->Email    = $Email;
      $this->Telefone = $Telefone;
      $this->CPF      = $CPF;
    }

    // Getters   
    public function getNome() {
      return $this->Nome;
    }
    public function getRG() {
      return $this->RG;
    }
    public function getEmail() {
      return $this->Email;
    }
    public function getTelefone() {
      return $this->Telefone;
    }
    public function getCPF() {
      return $this->CPF;
    }

    // Setters
    public function setNome($Nome) {
      $this->Nome = $Nome;
    }
    public function setRG($RG) {
      $this->RG = $RG;
    }
    public function setEmail($Email) {
      $this->Email = $Email;
    }
    public function setTelefone($Telefone) {
      $this->Telefone = $Telefone;
    }
    public function setCPF($CPF) {
      $this->CPF = $CPF;
    }

    // Métodos

    public static function validaCPF($CPF) {
      return (strlen((string)$CPF) == 11);
    }

    public static function getAtributos($Class) {
      if(self::class === $Class) {
        return [
          "Nome",
          "RG",
          "Email",
          "CPF",
          "Telefone"          
        ];
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getAtributos($Class);
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class) {
        return [
          $this->Nome,
          $this->RG,
          $this->Email,
          formatarCPF($this->CPF),
          formatarTelefone($this->Telefone),
          $this->Endereco->ListarEndereco()
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