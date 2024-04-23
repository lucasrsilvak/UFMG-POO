<?php
  include_once('/home/runner/Dental-Clinic-Software-Backend/Utils/mask.php');
  function autoloader($pClassName) {
      //echo __NAMESPACE__;
      $path = __DIR__ . '/Classes/' . $pClassName . '.php';
      if (is_file($path)) {
          include_once $path;
      }
      else {
          $path = __DIR__ . '/Classes/' . $pClassName . '.php';
          if (is_file($path)) {
              include_once $path;
          }
          else
              throw( new Exception('Não foi encontrada a definição da classe '.$pClassName.' na pasta classes.'));
      }
  }
  spl_autoload_register('autoloader');
?>