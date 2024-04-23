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

<?php include "nav.php"; ?>

<?php
  $paraListar = $_GET["Listar"];
  $Lista = $paraListar::getRecords();
  $atributos = $paraListar::getAtributos($paraListar);
?>

<div class="container">
  <h2 class="m-4">Listando <?= $paraListar ?></h2>
  <table class="table">
    <thead>
      <tr>
        <?php foreach($atributos as $att) : ?>  
          <th scope="col"><?= $att ; ?></th>
        <?php endforeach; ?>
      </tr>
      <?php foreach($Lista as $Elemento) : ?>
        <tr>
          <?php
            if (!($Elemento->getDados($paraListar) == null)) {
              foreach($Elemento->getDados($paraListar) as $Dado) : ?>
                <td><?= $Dado; ?></td>
              <?php endforeach; 
            }
          ?>
        </tr>
      <?php endforeach; ?>
    </thead>
  </table>
</div>
