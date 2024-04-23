<?php
  function formatarMoeda($valor) {
      if ($valor != null) {
        return 'R$' . number_format($valor, 2, ',', '.');
      } else {
        return 'R$ 0,00';
      }
  }

  function formatarData($data) {
      return date('d/m/Y', strtotime($data));
  }

  function formatarTelefone($telefone) {
      return substr($telefone, 0, 5) . '-' . substr($telefone, 5, 9);
  }

  function formatarCPF($cpf) {
      return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
  }
?>