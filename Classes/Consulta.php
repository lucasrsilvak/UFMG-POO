<?php 
  class Consulta extends persist {
    static string $local_filename = "Consulta.txt";

    protected Dentista $DentistaExecutor;
    protected Paciente $Paciente;
    protected string   $Horario;
    protected int      $Data;
    protected int      $DuracaoPrevista;
    protected bool     $Concluido;
    
    public function __construct($Paciente, $DentistaExecutor, $Data, $Horario, $DuracaoPrevista) {
      $this->Paciente          = $Paciente;
      $this->DentistaExecutor  = $DentistaExecutor;
      $this->Data              = $Data;
      $this->Horario           = $Horario;
      $this->DuracaoPrevista   = $DuracaoPrevista;
      $this->Concluido         = false;

      $Data1 = str_split((string)$Data, 4);
      $Data2 = str_split($Data1[1], 2);
      $PrintData = $Data2[1] . "/". $Data2[0] . "/" . $Data1[0];

      $this->save();
      Logger::logMessage(get_class($this) . " às " . $PrintData . " agendada com sucesso!", null);
    }

    // Getters
    public function getPaciente() {
      return $this->Paciente;
    }
    public function getDentistaExecutor() {
      return $this->DentistaExecutor;
    }
    public function getData() {
      return $this->Data;
    }
    public function getHorario() {
      return $this->Horario;
    }
    public function getDuracaoPrevista() {
      return $this->DuracaoPrevista;
    }
    public function getConcluido() {
      return $this->Concluido;
    }

    // Setters
    public function setPaciente($Paciente) {
      $this->Paciente = $Paciente;
    }
    public function setDentistaExecutor($DentistaExecutor) {
      $this->DentistaExecutor = $DentistaExecutor;
    }
    public function setData($Data) {
      $this->Data = $Data;
    }
    public function setHorario($Horario) {
      $this->Horario = $Horario;
    }
    public function setDuracaoPrevista($DuracaoPrevista) {
      $this->DuracaoPrevista = $DuracaoPrevista;
    }
    public function setConcluido($Concluido) {
      $this->Concluido = $Concluido;
    }

    // Listar
    //$Paciente, $DentistaExecutor, $Data, $Horario, $DuracaoPrevista
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Paciente",
          "Dentista Executor",
          "Data",
          "Horário",
          "Duração Prevista"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Paciente->getNome(),
          $this->DentistaExecutor->getNome(),
          formatarData($this->Data),
          $this->Horario,
          $this->DuracaoPrevista
        ];
      }
    }
    
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>