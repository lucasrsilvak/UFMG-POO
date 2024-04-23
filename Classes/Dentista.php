<?php
  class Dentista extends Funcionario {
    protected string $CRO;
    protected        $Especialidade;
    protected        $ConsultasRealizadas;

    public function __construct($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidades) {
      parent::__construct($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, null, "Dentista");
      
      $this->CRO                 = $CRO;
      $this->Especialidade       = array();
      $this->ConsultasRealizadas = array();
      
      foreach($Especialidades as $Especialidade) {
        array_push($this->Especialidade, $Especialidade);
      }
      $this->save();
    }

    // Getters
    public function getCRO() {
      return $this->CRO;
    }
    public function getEspecialidade() {
      return $this->Especialidade;
    }
    public function getConsultasRealizadas() {
      return $this->ConsultasRealizadas;
    }

    // Setters
    public function setCRO($CRO){
      $this->CRO = $CRO;
    }
    public function setEspecialidade($Especialidade){
      $this->Especialidade = array();
      array_push($this->Especialidade, $Especialidade);
    }

    // Metodos
    public function adicionarConsulta($Consulta) {
      array_push($this->ConsultasRealizadas, $Consulta);
      $this->save();
    }
    public function adicionarEspecialidade($Especialidade) {
      array_push($this->Especialidade, $Especialidade);
    }
    public function listarEspecialidade() {
      $arr = array();
      foreach($this->Especialidade as $Especialidade) {
        array_push($arr, $Especialidade->getEspecialidade());
      }
      return implode(", ", $arr);
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class) {
        return [
          "Nome",
          "RG",
          "Email",
          "CPF",
          "Telefone",
          "Endereco",
          "Salario",
          "CRO",
          "Especialidades"          
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
          $this->Endereco->ListarEndereco(),
          formatarMoeda($this->Salario),
          $this->CRO,
          $this->listarEspecialidade()
        ];   
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getDados($Class);
      } else if(get_class($this) == "DentistaParceiro") {
        return [
          $this->Nome,
          $this->RG,
          $this->Email,
          formatarCPF($this->CPF),
          formatarTelefone($this->Telefone),
          $this->Endereco->ListarEndereco(),
          formatarMoeda($this->Salario),
          $this->CRO,
          $this->listarEspecialidade()
        ];   
      }
    }
  }
?>
