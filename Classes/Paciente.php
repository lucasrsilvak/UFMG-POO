<?php
  class Paciente extends Pessoa {
    static string $local_filename = "Paciente.txt";
    
    protected Cliente $ResponsavelFinanceiro;
    protected int     $DataNascimento;

    public function __construct($Nome, $RG, $Email, $Telefone, $DataNascimento, $ResponsavelFinanceiro) {
      parent::__construct($Nome, $RG, $Email, $Telefone, null);
      
      $this->DataNascimento        = $DataNascimento;
      $this->ResponsavelFinanceiro = $ResponsavelFinanceiro;

      Logger::logMessage($Nome, $this);
      $this->save();
    }
    
    // Getters
    public function getDataNascimento() {
      return $this->DataNascimento;
    }
    public function getResponsavelFinanceiro(){
      return $this->ResponsavelFinanceiro;
    }

    // Setters
    public function setDataNascimento($DataNascimento){
      $this->DataNascimento = $DataNascimento;
    }
    public function setResponsavelFinanceiro($ResponsavelFinanceiro){
      $this->ResponsavelFinanceiro = $ResponsavelFinanceiro;
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Nome",
          "RG",
          "Email",
          "Telefone",
          "Data de Nascimento",
          "Responsavel Financeiro"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Nome,
          $this->RG,
          $this->Email,
          $this->Telefone,
          formatarData($this->DataNascimento),
          $this->ResponsavelFinanceiro->getNome()
        ];
      }
    }
    
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>