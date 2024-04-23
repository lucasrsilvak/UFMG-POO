<?php
  function escreverArquivo($caminho, $conteudo) {
      $file_handle = fopen($caminho, 'w');
  
      if ($file_handle !== false) {
          fwrite($file_handle, $conteudo);
          fclose($file_handle);
      }
  }
  
  function cleanData() {
    escreverArquivo('/home/runner/Dental-Clinic-Software-Backend/DataFiles/log.txt', '');
    $directory = '/home/runner/Dental-Clinic-Software-Backend/DataFiles/';
    $files = glob($directory . '*.txt');
    foreach ($files as $file_path) {
        escreverArquivo($file_path, '');
    }

    echo "LIMPANDO DADOS ANTERIORES...\n";
  }
  
  cleanData();
?>