<?php
  class Pagamento extends persist {
    static string $local_filename = "Pagamento.txt";

    protected MetodoDePagamento $Metodo;
    protected float   $Valor;
    protected float   $Taxa;
    protected ?int    $Data;
    protected int     $Parcelas;

    public function __construct($Valor, $Parcelas, $Data = null, $Metodo = null) {
      $this->Valor    = $Valor;
      $this->Metodo   = $Metodo;
      $this->Data     = $Data;
      $this->Parcelas = $Parcelas;
      $this->Taxa     = 0;


      Logger::logMessage("Pagamento " . $Metodo->getMetodo() . ", R$ " . number_format($Valor, 2, ',', '.') . " em " . $Parcelas . "x cadastrado com sucesso!", null);
      $this->save();
    }

    // Getters
    public function getValor() {
      return $this->Valor;
    }
    public function getMetodo() {
      return $this->Metodo;
    }
    public function getData() {
      return $this->Data;
    }
    public function getParcelas() {
      return $this->Parcelas;
    }
    public function getTaxa() {
      return $this->Taxa;
    }
    
    // Setters
    public function setValor($Valor) {
      $this->Valor = $Valor;
    }
    public function setMetodo($Metodo) {
      $this->Metodo = $Metodo;
    }
    public function setData($Data) {
      $this->Data = $Data;
    }
    public function setTaxa($Taxa) {
      $this->Taxa = $Taxa;
    }

    // Métodos
    
    public function aprovarPagamento($Data) {
      $this->Data   = $Data;
      switch($this->Metodo->getMetodo()) {
        case 'Débito':
          $this->Taxa = $this->Valor * 0.03;
          break;
        case 'Crédito':
          if ($this->Parcelas > 3) {
            $this->Taxa = $this->Valor * 0.07;
          } else {
            $this->Taxa = $this->Valor * 0.04;
          }
          break;
        default:
          break;
      }
      $this->save();
      
      $Cx = Caixa::getInstance();
      $Cx->adicionarPagamento($this);
      $Cx->save();
      
      $Data1 = str_split((string)$Data, 4);
      $Data2 = str_split($Data1[1], 2);
      $PrintData = $Data2[1] . "/". $Data2[0] . "/" . $Data1[0];

      Logger::logMessage("Pagamento " . $this->Metodo->getMetodo() .  " efetuado em " . $PrintData . " no valor de R$ " . number_format($this->Valor, 2, ',', '.') . "!", null);
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class) {
        return [
          "Metodo",
          "Valor",
          "Taxa",
          "Data",
          "Parcelas"
        ];
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getAtributos($Class);
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class) {
        return [
          $this->Metodo->getMetodo(),
          formatarMoeda($this->Valor),
          formatarMoeda($this->Taxa),
          formatarData($this->Data),
          $this->Parcelas
        ];   
      } else if(is_subclass_of(self::class, $Class)) {
        return $Class::getDados($Class);
      }
    }
    
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>