<?php
  class ControleDeAcesso extends persist {
    static string $local_filename = "ControleDeAcesso.txt";

    protected string $Tipo;
    protected $Funcionalidades;
    
    public function __construct($Tipo, $Funcionalidades = null) {
      $this->Tipo = $Tipo;
      if ($Funcionalidades == "Todas") {
        $this->Funcionalidades = array(
          "AdicionarProcedimento",
          "AgendarConsulta",
          "AgendarConsultaAvaliacao",
          "AprovarOrcamento",
          "AprovarPagamento",
          "CadastrarCliente",
          "CadastrarDentista",
          "CadastrarDentistaParceiro",
          "CadastrarEndereco",
          "CadastrarEspecialidade",
          "CadastrarMetodoDePagamento",
          "CadastrarPaciente",
          "CadastrarPagamento",
          "CadastrarProcedimento",
          "CadastrarOrcamento",
          "ConcluirConsulta"
        );
      } else {
        $this->Funcionalidades = $Funcionalidades;
      }
      Logger::logMessage($Tipo, $this);
      $this->save();
    }

    // Getters
    public function getTipo() {
      return $this->Tipo;
    }
    public function getFuncionalidades() {
      return $this->Funcionalidades;
    }
    
    // Setters
    public function setTipo($Tipo) {
      $this->Tipo = $Tipo;
    }
    public function setFuncionalidades($Funcionalidades) {
      $this->Tipo = $Funcionalidades;
    }

    // Métodos

    public function removerFuncionalidade($Funcionalidade) {
      $index = array_search($Funcionalidade, $this->Funcionalidades);
      if ($index !== false) {
        unset($this->Funcionalidades[$index]);
        Logger::logMessage("{$Funcionalidade} removida de {$this->Tipo}!\n", null);
      }
      $this->save();
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Tipo",
          "Funcionalidades"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Tipo,
          implode(", ", $this->Funcionalidades)
        ];
      }
    }
    
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>