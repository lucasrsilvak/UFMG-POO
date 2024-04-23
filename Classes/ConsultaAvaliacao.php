<?php
  class ConsultaAvaliacao extends Consulta {
    public function __construct($Paciente, $DentistaExecutor, $Data, $Horario){
      parent::__construct($Paciente, $DentistaExecutor, $Data, $Horario, 30);
    }
  }
?>