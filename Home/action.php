<?php 
  include_once('../global.php');
  header('Location: index.php');

  $Especialidades = Especialidade::getRecords();
  $Orcamentos     = Orcamento::getRecords();

  switch($_GET["Objeto"]) {
    case 'Procedimento': 
      $Procedimento = new Procedimento($_GET["Tipo"], $_GET["Descricao"], $_GET["Detalhamento"], $_GET["Valor"], $Especialidades[$_GET["Especialidade"]]);
      $Orcamento = $Orcamentos[$_GET["OrcamentoID"]-1];
      $Orcamento->adicionarProcedimento($Procedimento);
      break;
    case 'Desconectar':
      $Usuario = Usuario::getRecords();
      $UsuarioLogado = $Usuario[sizeof($Usuario)-1];
    
      $Login = UsuarioLogado::getInstance();
      $Login->setUsuario($UsuarioLogado);

      $Login->deslogar();
      $Login->save();
      break;
    case 'Logar':
      if (isset($_GET['Nome']) && isset($_GET['Senha'])) {
        $Login = UsuarioLogado::getInstance();
        $Login->logar($_GET['Nome'], $_GET['Senha']);
        $_SESSION['USER'] = $Login->getUsuario();
      }
      break;
  }
?>