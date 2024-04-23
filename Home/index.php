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

<div class="container mt-4 mb-4">
    <div class="card col-md-12">
        <h1 class="display-4">Bem vindo a Clínica do Receio</h1>
        <p class="lead">Aonde nenhum tratamento fica sem esperança.</p>
        <hr class="my-4">
        <p>Contamos com um time de especialistas.</p>
        <a href="perfil.php">
          <button class="btn btn-info btn-lg m-4 role="button">Listagem de Classes</button>
        </a>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <img class="card-img-top" src="../Imagens/dinheiro.jpg" alt="Services" width="200" height="200">
        <div class="card-body">
          <h5 class="card-title">Finanças</h5>
          <p class="card-text">Fique por dentro de nossos cofres.</p>
          <a href="list.php?Listar=Caixa" class="btn btn-info">Verificar Caixa</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <img class="card-img-top" src="../Imagens/dentista.jpg" alt="Doctors" width="200" height="200">
        <div class="card-body">
          <h5 class="card-title">Nossos Dentistas</h5>
          <p class="card-text">Para você ter um sorrisão bacana!</p>
          <a href="list.php?Listar=Dentista" class="btn btn-info">Conheça-os</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <img class="card-img-top" src="../Imagens/Dente.gif" alt="Contact" width="200" height="200">
        <div class="card-body">
          <h5 class="card-title">Seus Dentes</h5>
          <p class="card-text">Como nunca antes!</p>
          <a href="#" class="btn btn-info">Contate-nos</a>
        </div>
      </div>
    </div>
  </div>

  <hr class="my-4">

  <h2 class="text-center mb-4">Testemunhas</h2>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <p class="card-text">"Incrível!"</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">- PACIENTE FELIZ</small>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <p class="card-text">"Muito bom!"</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">- CLIENTE SATISFEITO</small>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
