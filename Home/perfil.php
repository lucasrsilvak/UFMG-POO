<?php
  include('../global.php');
  $Usuario = UsuarioLogado::getRecords();
  $Logado = $Usuario[sizeof($Usuario)-1]->getUsuario();
  $Controle = null;
  $mensagem = "Funcionalidades (maioria não funciona)";
  if ($Logado !== null) {
    $Controle = $Logado->getControle();
  } else {
    $mensagem = "Faça Login para usar Funcionalidades";
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../Imagens/logogreen.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Clinica do Receio</title>
</head>

<body>

<?php include "nav.php"; ?>

<div class="container">
  <div class="mt-1"><h2>Display de Todas as Classes</h2></div>
  <div class="mt-1 row">
    <?php 
      $dirPath = '../DataFiles/';
      
      $elements = scandir($dirPath);
      
      foreach ($elements as $element) {
          if ($element != '.' && $element != '..') {
            if ($element == "log.txt") {continue;}
            $element = str_replace('.txt', '', $element);
              ?>
                <div class="col-md-3 mb-3">
                  <form action="list.php" method="GET">
                    <input type="hidden" name="Listar" value="<?= $element; ?>">
                    <button class="btn btn-info btn-block" type="submit">Ver <?= $element; ?></button>
                  </form>
                </div>
              <?php
          }
      }
    ?>  
  </div>
  <div class="mt-1"><h2><?= $mensagem ?></h2></div>
  <div class="mt-1 row">
    <?php
      if ($Controle != null) {
        foreach ($Controle->getFuncionalidades() as $funcionalidade) {
          $value = null;
          $action = null;
          if (strpos($funcionalidade, 'Cadastrar') !== false) {
            $action = "function.php";
            $value = str_ireplace('Cadastrar', '', $funcionalidade);
          }
        ?>
          <div class="col-md-3 mb-3">
            <form action="<?= $action; ?>" method="GET">
              <input type="hidden" name="Funcionar" value="<?= $value; ?>">
              <button class="btn btn-warning btn-block" type="submit"><?= $funcionalidade; ?></button>
            </form>
          </div>
        <?php } 
      } ?>  
  </div>
</div>
</body>