<?php
  class ConsultaTemProcedimento extends persist {
    static string $local_filename = "ConsultaTemProcedimento.txt";

    protected Tratamento $Tratamento;
    protected Consulta   $Consulta;
    protected            $Procedimentos;
    
    public function __construct($Tratamento, $Consulta, $ListaProcedimentos) {  
      $this->Tratamento    = $Tratamento;
      $this->Consulta      = $Consulta;
      $this->Procedimentos = array();

      foreach ($ListaProcedimentos as $Procedimento) {
        array_push($this->Procedimentos, $Procedimento);
      }
      $this->validarEspecialidadeDentista($Consulta);
    Logger::logMessage(sizeof($ListaProcedimentos) . " Procedimento(s) adicionado(s) à Consulta!\n", null);
    }
    
    // Getters
    public function getConsulta() {
      return $this->Consulta;
    }
    public function getProcedimentos() {
      return $this->Procedimentos;
    }
    public function getTratamento() {
      return $this->Tratamento;
    }

    // Setters
    public function setConsulta($Consulta) {
      $this->Consulta = $Consulta;
    }
    public function setProcedimentos($Procedimentos) {
      $this->Procedimentos = $Procedimentos;
    }
    public function setTratamento($Tratamento) {
      $this->Tratamento = $Tratamento;
    }

    // Metodos
    public function addProcedimento($Procedimento) {
      array_push($this->Procedimentos, $Procedimento);
    }   
    public function concluir() {
      $Data1 = str_split((string)$this->Consulta->getData(), 4);
      $Data2 = str_split($Data1[1], 2);
      $PrintData = $Data2[1] . "/". $Data2[0] . "/" . $Data1[0];
      $this->Consulta->setConcluido(true);
      $this->Consulta->getDentistaExecutor()->adicionarConsulta($this);

      Logger::logMessage("Consulta em " . $PrintData . " - " . $this->Consulta->getHorario() . " foi concluída!", null);
    }
    public function validarEspecialidadeDentista($Consulta) {
      $Validado = 0;
      $Total    = sizeof($this->Procedimentos);
      foreach($this->Procedimentos as $Procedimento) {
        foreach($this->Consulta->getDentistaExecutor()->getEspecialidade() as $Especialidade) {
          if ($Procedimento->getEspecialidade() == $Especialidade) {
            $Validado++;
          }
        }
      }
      if ($Validado == $Total) {
        Logger::logMessage("Dentista é apto para o(s) procedimento(s)!", null);

      } else {
        Logger::logMessage("Dentista não é apto para o(s) procedimento(s)!", null);
      }
      return ($Validado == $Total);
    }
      
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }