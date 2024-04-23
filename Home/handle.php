<?php
    include "../global.php";
    header("Location: list.php?Listar=" . $_GET["class"]);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $className = $_GET["class"];

    // Include the class file

    // Get the constructor parameters
    $reflection = new ReflectionClass($className);
    $constructorParameters = $reflection->getConstructor()->getParameters();

    // Initialize an array to store the constructor arguments
    $constructorArguments = [];

    // Get the values from the form data
    foreach ($constructorParameters as $parameter) {
        $parameterName = $parameter->getName();
        $constructorArguments[$parameterName] = $_GET[$parameterName];
    }

    // Create an instance of the class with the form data
    $instance = $reflection->newInstanceArgs($constructorArguments);

    // Optionally, you can redirect or display a success message
    exit();
}

?>