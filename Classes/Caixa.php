<?php
  class Caixa extends persist {
    static string $local_filename = "Caixa.txt";
    static private $ptr_container = null;

    protected float $TaxaImposto = 0.2;

    protected int   $ID;
    protected float $Saldo;
    protected       $ListaPagamentos;

    public function __construct() {
      $this->ID               = 1;
      $this->Saldo            = 0;
      $this->ListaPagamentos = array();
    }

    //Getters
    public function getSaldo() {
      return $this->Saldo;
    }
    public function getListaPagamentos() {
      return $this->ListaPagamentos;
    }
    
    //Setters
    public function setSaldo($Saldo) {
      $this->Saldo = $Saldo;
    }
    public function setListaPagamentos($ListaPagamentos) {
      $this->ListaPagamentos = $ListaPagamentos;
    }

    // Singleton

    static function getInstance() {
        if (self::$ptr_container == null) {
          self::$ptr_container = new self();
        }
        return self::$ptr_container;
    }
    
    //Metodos
    public function calcularImposto($Mes) {
      $Soma = 0;
      foreach($this->ListaPagamentos as $Pagamento) {
        if ($Mes == substr((string)$Pagamento->getData(), 4, 2)) {
          $Soma += $Pagamento->getValor() * $this->TaxaImposto;
        }
      }
      return $Soma;
    }
    public function calcularSalarios($Mes) {
      $Salario = 0;
      foreach(Funcionario::getRecords() as $Funcionario) {
        if (get_class($Funcionario) != "DentistaParceiro") {
          $Salario += $Funcionario->getSalario();
        } else {
          $Salario += $Funcionario->calcularPagamento($Mes);
        }
      }
      return $Salario;
    }

    public function calcularRecebimentos($Mes) {
      $Recebimentos = 0;
      foreach($this->ListaPagamentos as $Pagamento) {
        $Data1 = str_split((string)$Pagamento->getData(), 4);
        $Data2 = str_split($Data1[1], 2);
        $PrintData = $Data2[1] . "/". $Data2[0] . "/" . $Data1[0];
        if ($Data2[0] == $Mes) {
          $Recebimentos += $Pagamento->getValor();
        }
      }
      return $Recebimentos;
    }

    public function calcularTaxas($Mes) {
      $Taxas = 0;
      foreach($this->ListaPagamentos as $Pagamento) {
        $Data1 = str_split((string)$Pagamento->getData(), 4);
        $Data2 = str_split($Data1[1], 2);
        $PrintData = $Data2[1] . "/". $Data2[0] . "/" . $Data1[0];
        if ($Data2[0] == $Mes) {
          $Taxas += $Pagamento->getTaxa();
        }
      }
      return $Taxas;
    }

    public function adicionarPagamento($Pagamento) {
      array_push($this->ListaPagamentos, $Pagamento);
      $this->Saldo += ($Pagamento->getValor() - $Pagamento->getTaxa());
      $this->save();
    }
    
    public function pagamentoDoMes($Mes) {
      $this->Saldo -= $this->calcularSalarios($Mes);
      $this->Saldo -= $this->calcularImposto($Mes);
      $this->save();
    }

    public function Leitura($Mes) {
      echo "Saldo:    R$ " . number_format($this->Saldo, 2, ',', '.') . "\n";
      echo "Impostos: R$ " . number_format($this->calcularImposto($Mes), 2, ',', '.') . "\n";
      echo "Salários: R$ " . number_format($this->calcularSalarios($Mes), 2, ',', '.') . "\n";
      echo "Recebido: R$ " . number_format($this->calcularRecebimentos($Mes), 2, ',', '.') . "\n";
      echo "Taxas:    R$ " . number_format($this->calcularTaxas($Mes), 2, ',', '.') . "\n";
      echo "\nLista de Pagamentos\n\n";
      foreach($this->ListaPagamentos as $Pagamento) {
        $Data1 = str_split((string)$Pagamento->getData(), 4);
        $Data2 = str_split($Data1[1], 2);
        $PrintData = $Data2[1] . "/". $Data2[0] . "/" . $Data1[0];
        echo $PrintData . " - " . str_pad($Pagamento->getMetodo()->getMetodo(), 7) . " - R$ " . number_format($Pagamento->getValor(), 2, ',', '.') . "\n";
      }

      echo "\nLista de Salários\n\n";
      foreach(Funcionario::getRecords() as $Funcionario) {
        if (get_class($Funcionario) != "DentistaParceiro") {
          echo str_pad($Funcionario->getNome(), 30) . " | R$ " . number_format($Funcionario->getSalario(), 2, ',', '.') . "\n";

        } else {
          echo str_pad($Funcionario->getNome(), 30) . " | R$ " . number_format($Funcionario->calcularPagamento($Mes), 2, ',', '.') . "\n";
        }
      }
      $Valor = $this->Saldo - $this->calcularSalarios($Mes) - $this->calcularImposto($Mes);
      if ($Valor < 0) {
        echo "\nSaldo Esperado no Próximo Mês: -R$ " . number_format($Valor*-1, 2, ',', '.') . "\n\n";
      } else {
        echo "\nSaldo Esperado no Próximo Mês: R$ " . number_format($Valor, 2, ',', '.') . "\n\n";
      }
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Saldo",
          "Imposto",
          "Salários",
          "Recebimentos"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          formatarMoeda($this->Saldo),
          formatarMoeda($this->calcularImposto("11")),
          formatarMoeda($this->calcularSalarios("11")),
          formatarMoeda($this->calcularRecebimentos("11"))
        ];
      }
    }

    // Hooks
    static public function getFilename() {
      return get_called_class()::$local_filename;
    }
  }
?>