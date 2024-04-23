<?php
  include_once('../global.php');
  $Usuario = UsuarioLogado::getRecords();
  $Logado = $Usuario[sizeof($Usuario)-1]->getUsuario();
?>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="../Imagens/logoclear.png" height="33px"> Clinica do Receio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sobrenos.php">Sobre Nós</a>
        </li>
        <?php if(isset($Logado)) : ?>
          <li class="nav-item">
            <a href="perfil.php" class="nav-link">Perfil de <?php echo $Logado->getControle()->getTipo() . " " . ucfirst($Logado->getLogin()) ?></a>
          </li>  
          <li class="nav-item">
            <form name="Desconectar" action="action.php" method="get">
               <input type="hidden" name="Objeto" value="Desconectar">
              <button class="btn btn btn-warning" type="submit">Sair</button>
            </form>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro.php">Cadastro</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>