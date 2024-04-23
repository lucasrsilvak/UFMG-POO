<?php
  class Funcionario extends Pessoa {
    static string $local_filename = "Funcionario.txt";
    
    protected Endereco $Endereco;
    protected ?Usuario $Usuario;
    protected ?float   $Salario;
    protected string   $Cargo;

    public function __construct($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $Usuario, $Cargo) {
      parent::__construct($Nome, $RG, $Email, $Telefone, $CPF);
      
      $this->Endereco = $Endereco;
      $this->Salario  = $Salario;
      $this->Usuario  = $Usuario;
      $this->Cargo    = $Cargo;

      Logger::logMessage($Nome, $this);
      $this->save();
    }

    // Getters
    public function getEndereco(){
      return $this->Endereco;
    }
    public function getSalario(){
      return $this->Salario;
    }
    public function getUsuario(){
      return $this->Usuario;
    }
    public function getCargo() {
      return $this->Cargo;
    }
    
    // Setters
    public function setEndereco($Endereco){
      $this->Endereco = $Endereco;
    }
    public function setSalario($Salario){
      $this->Salario = $Salario;
    }
    public function setUsuario($Usuario){
      $this->Usuario = $Usuario;
    }
    public function setCargo($Cargo) {
      $this->Cargo = $Cargo;
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Nome",
          "RG",
          "Email",
          "Telefone",
          "CPF",
          "Endereco",
          "Salario",
          "Usuario",
          "Cargo"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        $Usuario = "";
        if ($this->Usuario != null) {
          $Usuario = $this->Usuario->getLogin();
        }
        return [
          $this->Nome,
          $this->RG,
          $this->Email,
          formatarTelefone($this->Telefone),
          formatarCPF($this->CPF),
          $this->Endereco->ListarEndereco(),
          formatarMoeda($this->Salario),
          $Usuario,
          $this->Cargo
        ];
      }
    }
  
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>