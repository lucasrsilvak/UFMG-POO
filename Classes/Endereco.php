<?php
  class Endereco extends persist {
    static string $local_filename = "Endereco.txt";

    protected ?string $Complemento;
    protected string  $Bairro;
    protected string  $Cidade;
    protected string  $Estado;
    protected string  $Rua;
    protected int     $Numero;

    public function __construct($Estado, $Cidade, $Bairro, $Rua, $Numero, $Complemento = null) {
      $this->Estado      = $Estado;
      $this->Rua         = $Rua;
      $this->Cidade      = $Cidade;
      $this->Bairro      = $Bairro;
      $this->Numero      = $Numero;
      $this->Complemento = $Complemento;

       Logger::logMessage($this->ListarEndereco(), $this);
      $this->save();
    }

    // Getters
    public function getRua() {
        return $this->Rua;
    }
    public function getCidade() {
        return $this->Cidade;
    }
    public function getEstado() {
        return $this->Estado;
    }
    public function getBairro() {
        return $this->Bairro;
    }
    public function getNumero() {
        return $this->Numero;
    }
    public function getComplemento() {
        return $this->Complemento;
    }

    // Setters
    public function setRua($Rua) {
      $this->Rua = $Rua;
    }
    public function setCidade($Cidade) {
      $this->Cidade = $Cidade;
    }
    public function setEstado($Estado) {
      $this->Estado = $Estado;
    }
    public function setBairro($Bairro) {
      $this->Bairro = $Bairro;
    }
    public function setNumero($Numero) {
      $this->Numero = $Numero;
    }
    public function setComplemento($Complemento) {
      $this->Complemento = $Complemento;
    }

    // Métodos
    public static function getAtributos() {
      return [
        "Estado",
        "Cidade",
        "Bairro",
        "Rua",
        "Numero",
        "Complemento"
      ];
    }

    public function getDados() {
      return [
        $this->Estado,
        $this->Cidade,
        $this->Bairro,
        $this->Rua,
        $this->Numero,
        $this->Complemento
      ];
    }
    
    public function ListarEndereco() {
        if($this->Complemento !=null) {
          return "{$this->getRua()}, {$this->getNumero()} - {$this->getComplemento()}, {$this->getBairro()}, {$this->getCidade()}, {$this->getEstado()}";
        } else {
          return "{$this->getRua()}, {$this->getNumero()}, {$this->getBairro()}, {$this->getCidade()}, {$this->getEstado()}";
        }
    }

    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>
