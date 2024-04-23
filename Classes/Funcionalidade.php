<?php
  class Funcionalidade extends persist {
    static string $local_filename = "Funcionalidade.txt";

    public function __construct() {}

    // Util
    
    private function verificarCargo($Funcao) {
      $Login = UsuarioLogado::getInstance();
      $Usuario = $Login->getUsuario();
      $Funcionalidades = $Usuario->getControle()->getFuncionalidades();
      foreach($Funcionalidades as $Funcionalidade) {
        if ($Funcionalidade == $Funcao) {
          return true;
        } 
      }
      Logger::logMessage("Erro! Cargo de {$Usuario->getLogin()} insuficiente!", null);
      return false;
    }
    
    private function validarLogado() {
      $Login = UsuarioLogado::getInstance();
      $Usuario = $Login->getUsuario();
      if ($Usuario == NULL) {
        Logger::logMessage("Erro! É necessário estar logado!", null);
        return false;
      }
      return true;
    }
    
    // Funcionalidades

    public function CadastrarEndereco($Estado, $Cidade, $Bairro, $Rua, $Numero, $Complemento) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new Endereco($Estado, $Cidade, $Bairro, $Rua, $Numero, $Complemento);
      } else {
        Logger::logMessage("Erro! Endereço não cadastrado!", null);
      }
      return null;
    }
    
    public function CadastrarEspecialidade($Especialidade, $Percentual) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new Especialidade($Especialidade, $Percentual);
      } else {
        Logger::logMessage("Erro! Especialidade não cadastrada!", null);
      }
      return null;
    }

    public function CadastrarMetodoDePagamento($Metodo) {
      if ($this->validarLogado()) {
        if ($this->verificarCargo(__FUNCTION__)) {
          return new MetodoDePagamento($Metodo);
        }
      } else {
        Logger::logMessage("Erro! Método de Pagamento não cadastrado!", null);
      }
      return null;
    }

    public function CadastrarPagamento($Valor, $Parcelas, $Data, $Metodo) {
      if ($this->validarLogado()) {
        if ($this->verificarCargo(__FUNCTION__)) {
          return new Pagamento($Valor, $Parcelas, $Data, $Metodo);
        }
      } else {
        Logger::logMessage("Erro! Pagamento não cadastrado!", null);
      }
      return null;
    }
    
    public function CadastrarProcedimento($Tipo, $Descricao, $Detalhamento, $ValorUnitario, $Especialidade) {
      if ($this->validarLogado()) {
        if ($this->verificarCargo(__FUNCTION__)) {
          return new Procedimento($Tipo, $Descricao, $Detalhamento, $ValorUnitario, $Especialidade);
        }
      } else {
        Logger::logMessage("Erro! Procedimento não cadastrado!", null);
      }
      return null;
    }
    
    public function CadastrarDentista($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidades) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new Dentista($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidades);
      }
      else {
        Logger::logMessage("Erro! Dentista não cadastrado!", null);
      }
    }
    
    public function CadastrarDentistaParceiro($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidade) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new DentistaParceiro($Nome, $RG, $Email, $Telefone, $CPF, $Endereco, $Salario, $CRO, $Especialidade);
      }
      else {
        Logger::logMessage("Erro! Dentista Parceiro não cadastrado!", null);
      }
    }
    
    public function CadastrarCliente($Nome, $RG, $Email, $Telefone, $CPF) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new Cliente($Nome, $RG, $Email, $Telefone, $CPF);
      }
      else {
        Logger::logMessage("Erro! Cliente não cadastrado!", null);
      }
    }
    
    public function CadastrarPaciente($Nome, $RG, $Email, $Telefone, $DataNascimento, $ResponsavelFinanceiro) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new Paciente($Nome, $RG, $Email, $Telefone, $DataNascimento, $ResponsavelFinanceiro);
      }
      else {
        Logger::logMessage("Erro! Paciente não cadastrado!", null);
      }
    }
    
    public function AgendarConsultaAvaliacao($Paciente, $Dentista, $Data, $Horario) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new ConsultaAvaliacao($Paciente, $Dentista, $Data, $Horario);
      }
      else {
        Logger::logMessage("Erro! Consulta de avaliação não agendada!", null);
      }
    }
    
    public function AgendarConsulta($Paciente, $Dentista, $Data, $Horario, $DuracaoPrevista, $Tratamento, $Procedimentos) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        $Consulta = new Consulta($Paciente, $Dentista, $Data, $Horario, $DuracaoPrevista);
        return new ConsultaTemProcedimento($Tratamento, $Consulta, $Procedimentos);
      }
      else {
        Logger::logMessage("Erro! Consulta não agendada!", null);
      }
    }
    
    public function CadastrarOrcamento($Paciente, $Dentista, $Data, $Procedimentos = array()) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new Orcamento($Paciente, $Dentista, $Data, $Procedimentos);
      }
      else {
        Logger::logMessage("Erro! Orcamento não cadastrado!", null);
      }
    }
    
    public function AprovarOrcamento($Orcamento, $Parcelamento, $Pagamentos) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        return new Tratamento($Orcamento, $Parcelamento, $Pagamentos);
      }
      else {
        Logger::logMessage("Erro! Orcamento não aprovado!", null);
      }
    }

    public function AdicionarProcedimento($Orcamento, $Procedimento) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        $Orcamento->adicionarProcedimento($Procedimento);
      }
      else {
        Logger::logMessage("Erro! {$Procedimento} não adicionado no Orçamento!", null);
      }
    }
    
    public function AprovarPagamento($Pagamento, $Data) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        $Pagamento->aprovarPagamento($Data);
      }
      else {
        Logger::logMessage("Erro! Pagamento não aprovado!", null);
      }
    }

    public function ConcluirConsulta($Consulta) {
      if ($this->validarLogado() && $this->verificarCargo(__FUNCTION__)) {
        $Consulta->concluir();
      }
      else {
        Logger::logMessage("Erro! Consulta não concluída!", null);
      }
    }
    
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>