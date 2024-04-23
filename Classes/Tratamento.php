<?php 
  class Tratamento extends Orcamento {
    static string $local_filename = "Tratamento.txt";

    protected string    $FormaDePagamento;
    protected int       $Parcelamento;
    protected           $ListaPagamentos;
  
    public function __construct($Orcamento, $Parcelamento, $Pagamentos) {
      parent::__construct($Orcamento->getPaciente(), $Orcamento->getDentista(), $Orcamento->getData(), $Orcamento->getProcedimentos());
      $this->Parcelamento    = $Parcelamento;
      $this->ListaPagamentos = $Pagamentos;

      $this->save();
    }
  
    // Getters
    public function getFormaDePagamento() {
      return $this->FormaDePagamento;
    }
    public function getParcelamento() {
      return $this->Parcelamento;
    }
    public function getListaPagamentos() {
      return $this->ListaPagamentos;
    }
    
    // Setters
    public function setFormaDePagamento($FormaDePagamento) {
      $this->FormaDePagamento = $FormaDePagamento;
    }
    public function setParcelamento($Parcelamento) {
      $this->Parcelamento = $Parcelamento;
    }
    
    // Métodos

    public function ListarPagamentos() {
      $arr = array();
      foreach($this->ListaPagamentos as $Pagamento) {
        array_push($arr, ($Pagamento->getParcelas() . 'x de ' 
 . formatarMoeda($Pagamento->getValor())));
      }
      return implode(", ", $arr);
    }

    //Listar
    //$Orcamento, $Parcelamento, $Pagamentos
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Parcelamento",
          "Pagamentos"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Parcelamento,
          $this->ListarPagamentos()
        ];  
      }
    }

    
    // Hooks
    
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>