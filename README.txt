TESTE GLOBAL
O arquivo TesteGlobal.php é o roteiro de testes do moodle.

PADRÃO DE PROJETO
Os padrões de projeto utilizados foram o (1) singleton e (2) facade :
(1)SINGLETON
Utilizado em UsuarioLogado.php : implementado o getInstance() adicionando mais controle ao acesso do sistema.
Utilizado em Caixa.php : implementado o getInstance().
(2)FACADE
Utilizado em Funcionalidades.php : ao realizar a requisição de uma funcionalidade no sistema é chamada uma rotina de verificação de login e validação do usuário, fornecendo acesso ao usuario ou fornecendo um erro.

OBSERVAÇÕES
Use o front-end em tela cheia, e não nesse visualizador do replit.