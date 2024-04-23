<?php
  class Procedimento extends persist {
    static string $local_filename = "Procedimento.txt";

    protected Especialidade $Especialidade;
    protected ?string       $Descricao;
    protected ?string       $Detalhamento;
    protected string        $Tipo;
    protected float         $ValorUnitario;

    public function __construct($Tipo, $Descricao, $Detalhamento, $ValorUnitario, $Especialidade) {  
      $this->Tipo          = $Tipo;
      $this->Descricao     = $Descricao;
      $this->Detalhamento  = $Detalhamento;
      $this->ValorUnitario = $ValorUnitario;
      $this->Especialidade = $Especialidade;

      Logger::logMessage($Tipo, $this);
      $this->save();
    }

    // Getters
    public function getTipo() {
      return $this->Tipo;         
    } 
    public function getDescricao() {
      return $this->Descricao;
    }
    public function getDetalhamento() {
      return $this->Detalhamento;
    }
    public function getEspecialidade() {
      return $this->Especialidade;
    } 
    public function getValorUnitario() {
      return $this->ValorUnitario;
    }

    // Setters
    public function setTipo($Tipo) {
      $this->Tipo = $Tipo;
    }
    public function setDescricao($Descricao) {
      $this->Descricao = $Descricao;
    }
    public function setDetalhamento($Detalhamento) {
      $this->Detalhamento = $Detalhamento;
    }
    public function setEspecialidade($Especialidade) {
      $this->Especialidade = Especialidade;
    }  
    public function setValorUnitario($ValorUnitario) {
      $this->ValorUnitario = $ValorUnitario;
    }

    // Métodos
    public function concluir() {
      $this->Concluido = true;
    }

    //Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Tipo",
          "Descricao",
          "Detalhamento",
          "Valor Unitário",
          "Especialidade"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Tipo,
          $this->Descricao,
          $this->Detalhamento,
          formatarMoeda($this->ValorUnitario),
          $this->Especialidade->getEspecialidade()
        ];  
      }
    }
    
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>
