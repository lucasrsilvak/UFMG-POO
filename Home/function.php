<?php

class GenericForm {
    public static function generateForm($className) {
        $reflection = new ReflectionClass($className);
        $constructorParameters = $reflection->getConstructor()->getParameters();

        echo "<h2 class='text-center'>Cadastro de $className</h2>";

        echo '<form action="handle.php" method="get">';
        foreach ($constructorParameters as $parameter) {
            $parameterName = $parameter->getName();
            echo "<div class='form-group'>";
            echo "<label for='$parameterName'>$parameterName:</label>";
            echo "<input type='text' class='form-control' name='$parameterName' required>";
            echo '</div>';
        }

        echo "<input type='hidden' name='class' value='$className'>";
        echo '<button type="submit" class="btn btn-info btn-block">Cadastrar</button>';
        echo '</form>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
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
  <div class="container mt-5">

  <?php
    GenericForm::generateForm($_GET["Funcionar"]);
  ?>
  </div>  
</body>
</html>