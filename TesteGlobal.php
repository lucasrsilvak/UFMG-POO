<?php
  include_once('global.php');
  include('Utils/cleanData.php');

  echo "\nCRIANDO CONTROLES:\n\n";

  $ControleDeAcesso0 = new ControleDeAcesso("Secretário", "Todas");
  $ControleDeAcesso1 = new ControleDeAcesso("Administrador", "Todas");

  $ControleDeAcesso0->removerFuncionalidade("CadastrarProcedimento");

  echo "\nCRIANDO USUÁRIOS:\n\n";

  $Sistema = new Funcionalidade();

  $Endereco0 = new Endereco("MG", "Vale das Bananeiras", "Bairro Airton Marques", "Avenida das Macieiras", 719, null);
  $Endereco1 = new Endereco("RJ", "Vila do Ouro", "Bairro das Andorinhas", "Avenida Dolores Pimentel", 312, "Apartamento");

  $Usuario0 = new Usuario("Tatiana", "123", "tatianamarques@gmail.com", $ControleDeAcesso0);
  $Usuario1 = new Usuario("Bonaparte", "123", "gabrielsantos@gmail.com", $ControleDeAcesso1);

  $Funcionario0 = new Funcionario("Tatiana Belso Marques", "BA-50.044.566", "tatianamarques@gmail.com", 963714468, "27106621222", $Endereco0, 1900, $Usuario0, "Secretário");
  $Funcionario1 = new Funcionario("Gabriel Bonaparte Santos", "BA-43.279.280", "gabrielsantos@gmail.com", 954654456, "90443507903", $Endereco1, 3100, $Usuario1, "Administrador");

  echo "\nTESTES DO SISTEMA:\n\n";

  $Sistema->CadastrarProcedimento("Limpeza", null, null, 200, null);

  $Login = UsuarioLogado::getInstance();
  $Login->logar("Tatiana", "123");

  $Sistema->CadastrarProcedimento("Limpeza", null, null, 200, null);

  $Login->deslogar();

  $Login->logar("Bonaparte", "123");

  $Caixa = Caixa::getInstance();
  
  echo "\nCRIANDO ESPECIALIDADES:\n\n";
  
  $Especialidade0 = $Sistema->CadastrarEspecialidade("Clínica Geral", 0.4);
  $Especialidade1 = $Sistema->CadastrarEspecialidade("Endodontia", 0.4);
  $Especialidade2 = $Sistema->CadastrarEspecialidade("Cirurgia", 0.4);
  $Especialidade3 = $Sistema->CadastrarEspecialidade("Estética", 0.4);

  echo "\n\nCRIANDO PROCEDIMENTOS:\n\n";

  $Procedimento0 = $Sistema->CadastrarProcedimento("Limpeza", null, null, 200, $Especialidade0);
  $Procedimento1 = $Sistema->CadastrarProcedimento("Restauração", null, null, 185, $Especialidade0);
  $Procedimento2 = $Sistema->CadastrarProcedimento("Extração Comum", "Não inclui dente siso", null, 280, $Especialidade0);
  $Procedimento3 = $Sistema->CadastrarProcedimento("Canal", null, null, 800, $Especialidade1);
  $Procedimento4 = $Sistema->CadastrarProcedimento("Extração de Siso", "Valor por dente", null, 400, $Especialidade2);
  $Procedimento5 = $Sistema->CadastrarProcedimento("Clareamento a laser", null, null, 1700, $Especialidade3);
  $Procedimento6 = $Sistema->CadastrarProcedimento("Clareamento de moldeira", "Clareamento caseiro", null, 900, $Especialidade3);

  echo "\n\nCRIANDO MÉTODOS DE PAGAMENTO:\n\n";

  $Metodo0 = $Sistema->CadastrarMetodoDePagamento("PIX");
  $Metodo1 = $Sistema->CadastrarMetodoDePagamento("Crédito");
  
  echo "\n\nCRIANDO ENDERECOS:\n\n";
  
  $Endereco2 = $Sistema->CadastrarEndereco("RJ", "Riacho dos Engenheiros", "Bairro dos Urubus", "Rua dos Advogados", 10, "Sobrado");

  $Endereco3 = $Sistema->CadastrarEndereco("RJ", "Cidade dos Almoxarifados", "Bairro dos Dentistas", "Rua das Almas", 889, "Apartamento");
  
  echo "\n\nCRIANDO DENTISTAS:\n\n";
  
  $Dentista0 = $Sistema->CadastrarDentista("Gabriel da Silva Nascimento", "MG-45.495.948", "gabrielnascimento@gmail.com", 960805364, "78584409774", $Endereco2, 5000, "CRO-MG 9050", array($Especialidade0, $Especialidade1));

  $DentistaParceiro0 = $Sistema->CadastrarDentistaParceiro("Omar Machado Lacerda", "MG-95.435.773", "omarlacerda@gmail.com", 928005768, "31103204018", $Endereco3, null, "CRO-MG 8156", array($Especialidade2, $Especialidade3));

  echo "\n\nCRIANDO CLIENTE:\n\n";

  $Cliente0 = $Sistema->CadastrarCliente("Fernanda Batista Luz", "DF-21.861.737", "fernandaluz@gmail.com", 917325673, "50481292209");
  
  echo "\n\nCRIANDO PACIENTE:\n\n";
  
  $Paciente0 = $Sistema->CadastrarPaciente("Gustavo Santana Melo", "DF-18.329.417", "gustavomelo@gmail.com", 934383761, 12122004, $Cliente0);

  echo "\n\nCRIANDO CONSULTA DE AVALIAÇÃO:\n\n";

  $ConsultaAvaliacao0 = $Sistema->AgendarConsultaAvaliacao($Paciente0, $DentistaParceiro0, 20231106, "14:00");

  echo "\n\nCRIANDO ORCAMENTO:\n\n";
  
  $Orcamento0 = $Sistema->CadastrarOrcamento($Paciente0, $Dentista0, 20220929);

  $Sistema->AdicionarProcedimento($Orcamento0, $Procedimento0);
  $Sistema->AdicionarProcedimento($Orcamento0, $Procedimento5);
  $Sistema->AdicionarProcedimento($Orcamento0, $Procedimento1);
  $Sistema->AdicionarProcedimento($Orcamento0, $Procedimento1);

  echo "\n\nCRIANDO PAGAMENTOS:\n\n";

  $ValorTotal = $Orcamento0->getValorTotal();
  $Pagamento0 = $Sistema->CadastrarPagamento($ValorTotal*0.5, 1, null, $Metodo0);
  $Pagamento1 = $Sistema->CadastrarPagamento($ValorTotal*0.5, 3, null, $Metodo1);

  echo "\n\nGERANDO TRATAMENTO:\n\n";

  $Tratamento0 = $Sistema->AprovarOrcamento($Orcamento0, 4, array($Pagamento0, $Pagamento1));

  echo "\n\nCRIANDO CONSULTAS:\n\n";

  $Consulta0 = $Sistema->AgendarConsulta($Paciente0, $Dentista0, 20231113, "14:00", 60, $Tratamento0, array($Procedimento0));
  $Consulta1 = $Sistema->AgendarConsulta($Paciente0, $DentistaParceiro0, 20231120, "14:00", 60, $Tratamento0, array($Procedimento5));
  $Consulta2 = $Sistema->AgendarConsulta($Paciente0, $Dentista0, 20231127, "14:00", 60, $Tratamento0, array($Procedimento1));
  $Consulta3 = $Sistema->AgendarConsulta($Paciente0, $Dentista0, 20231204, "14:00", 60, $Tratamento0, array($Procedimento1));

  $Sistema->ConcluirConsulta($Consulta0);
  $Sistema->ConcluirConsulta($Consulta1);
  
  echo "\n\nEFETUANDO PAGAMENTOS:\n\n";
  
  $Sistema->AprovarPagamento($Pagamento0, 20231106);
  $Sistema->AprovarPagamento($Pagamento1, 20231113);

  echo "\n\nCALCULANDO INFORMAÇÕES FINANCEIRAS:\n\n";
  
  $Caixa->leitura("11");

  $Login->deslogar();
?>