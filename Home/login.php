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


<?php include 'nav.php'; ?>

<form class="container" name="Login" action="action.php" method="get">
  <div class="m-2"><h3>Login</h3></div>
  <div class="rounded-bottom p-4">
    <div class="mb-3">
      <label class="form-label">Login: </label><input class="form-control" id="Nome" name="Nome" placeholder="Bonaparte"><br>
    </div>
    <div class="mb-3">
      <label class="form-label">Senha: </label><input class="form-control" type="password" id="Senha" name="Senha" placeholder="123"><br>
    </div>
     <input type="hidden" name="Objeto" value="Logar">
    <button type="submit" class="btn btn-info">Entrar</button>
  </div>
</form>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
