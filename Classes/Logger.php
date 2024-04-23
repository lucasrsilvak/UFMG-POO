<?php
date_default_timezone_set('America/Sao_Paulo');

class Logger {
    public static function logMessage($message, $class = null) {
        if (isset($class)) {
            $message = "Objeto " . $message . " da classe " . get_class($class) . " cadastrado com sucesso!";
        }

        $timestamp = date('H:i');
        $output = "[$timestamp] [Sistema] $message" . PHP_EOL;

        echo $output;
      
        $result = file_put_contents("/home/runner/Dental-Clinic-Software-Backend/log.txt", $output, FILE_APPEND);
    }
}

?>
