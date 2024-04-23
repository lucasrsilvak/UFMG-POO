<?php
  class DentistaParceiro extends Dentista {    
    public function __construct($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidade) {
      parent::__construct($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidade);
    }

    // Métodos
    public function calcularPagamento($Mes) {
      $Salario = 0;
      foreach($this->ConsultasRealizadas as $ConsultaInfo) {
        if ($Mes == substr((string)$ConsultaInfo->getConsulta()->getData(), 4,2)) {
          if ($ConsultaInfo->getConsulta()->getConcluido()) {
            foreach($ConsultaInfo->getProcedimentos() as $Procedimento) {
              $Especialidade = $Procedimento->getEspecialidade();
              $Salario += $Especialidade->getValorPercentual() * $Procedimento->getValorUnitario();
            }
          }
        }
      }
      return $Salario;
    }

    // Listar
    //$Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidade
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
          formatarTelefone($this->Telefone),
          formatarCPF($this->CPF),
          $this->Endereco->ListarEndereco(),
          $this->Salario,
          $this->CRO,
          $this->listarEspecialidade()
        ];
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getDados($Class);
      }
    }
  }
?>