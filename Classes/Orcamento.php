 <?php
  class Orcamento extends persist {
    static string $local_filename = "Orcamento.txt";

    protected Dentista $DentistaResponsavel;
    protected Paciente $Paciente;
    protected float    $ValorTotal;
    protected bool     $Aprovado;
    protected int      $Data;
    protected          $Procedimentos;
    
    public function __construct($Paciente, $Dentista, $Data, $Procedimentos = array()) {
      $this->Paciente            = $Paciente;
      $this->DentistaResponsavel = $Dentista;
      $this->Data                = $Data;
      $this->Procedimentos       = $Procedimentos;
      $this->ValorTotal          = 0;
      $this->Aprovado            = false;

      foreach($Procedimentos as $Procedimento) {
          array_push($this->Procedimentos, $Procedimento);
          $this->ValorTotal += $Procedimento->getValorUnitario();
      }

      Logger::logMessage($Paciente->getNome(), $this);
      $this->save();
    }

    // Getters
    public function getPaciente() {
      return $this->Paciente;
    }    
    public function getDentista() {
      return $this->DentistaResponsavel;
    }
    public function getData() {
      return $this->Data;
    }
    public function getProcedimentos() {
      return $this->Procedimentos;
    }
    public function getValorTotal() {
      return $this->ValorTotal;
    }
    public function getAprovado() {
      return $this->Aprovado;
    }
    
    // Setters
    public function setDentista(Dentista $Dentista) {
      $this->DentistaResponsavel = $Dentista;
    }
    public function setData(int $Data) {
      $this->Data = $Data;
    }
    public function setProcedimentos($Procedimentos) {
      $this->Procedimentos = $Procedimentos;
    }
    public function setValorTotal(float $ValorTotal) {
      $this->ValorTotal = $ValorTotal;
    }
    public function setAprovado(bool $Aprovado) {
      $this->Aprovado = $Aprovado;
    }
    
    // Métodos
    public function adicionarProcedimento($Procedimento) {
      array_push($this->Procedimentos, $Procedimento);
      $this->ValorTotal += $Procedimento->getValorUnitario();
      $this->save();
    }
    
    public function aprovarOrcamento($Parcelamento, $ListaPagamentos) {
      $Tratamento = new Tratamento($this, $Parcelamento, $ListaPagamentos);
      $this->Aprovado = true;
      return $Tratamento;
    }
    public function listarProcedimentos() {
      $Lista = array();
      foreach($this->Procedimentos as $Procedimento) {
        array_push($Lista, $Procedimento->getTipo());
      }
      return implode(", ", $Lista);
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Paciente",
          "Dentista",
          "Data",
          "Procedimentos",
          "Valor Total"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Paciente->getNome(),
          $this->DentistaResponsavel->getNome(),
          formatarData($this->Data),
          $this->listarProcedimentos(),
          formatarMoeda($this->ValorTotal)
        ];
      }
    }

    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>