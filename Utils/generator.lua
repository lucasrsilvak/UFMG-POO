function removeAcento(str)
  local tableAccents = {}
    tableAccents["À"] = "A"
    tableAccents["Á"] = "A"
    tableAccents["Â"] = "A"
    tableAccents["Ã"] = "A"
    tableAccents["Ä"] = "A"
    tableAccents["Å"] = "A"
    tableAccents["Æ"] = "AE"
    tableAccents["Ç"] = "C"
    tableAccents["È"] = "E"
    tableAccents["É"] = "E"
    tableAccents["Ê"] = "E"
    tableAccents["Ë"] = "E"
    tableAccents["Ì"] = "I"
    tableAccents["Í"] = "I"
    tableAccents["Î"] = "I"
    tableAccents["Ï"] = "I"
    tableAccents["Ð"] = "D"
    tableAccents["Ñ"] = "N"
    tableAccents["Ò"] = "O"
    tableAccents["Ó"] = "O"
    tableAccents["Ô"] = "O"
    tableAccents["Õ"] = "O"
    tableAccents["Ö"] = "O"
    tableAccents["Ø"] = "O"
    tableAccents["Ù"] = "U"
    tableAccents["Ú"] = "U"
    tableAccents["Û"] = "U"
    tableAccents["Ü"] = "U"
    tableAccents["Ý"] = "Y"
    tableAccents["Þ"] = "P"
    tableAccents["ß"] = "s"
    tableAccents["à"] = "a"
    tableAccents["á"] = "a"
    tableAccents["â"] = "a"
    tableAccents["ã"] = "a"
    tableAccents["ä"] = "a"
    tableAccents["å"] = "a"
    tableAccents["æ"] = "ae"
    tableAccents["ç"] = "c"
    tableAccents["è"] = "e"
    tableAccents["é"] = "e"
    tableAccents["ê"] = "e"
    tableAccents["ë"] = "e"
    tableAccents["ì"] = "i"
    tableAccents["í"] = "i"
    tableAccents["î"] = "i"
    tableAccents["ï"] = "i"
    tableAccents["ð"] = "eth"
    tableAccents["ñ"] = "n"
    tableAccents["ò"] = "o"
    tableAccents["ó"] = "o"
    tableAccents["ô"] = "o"
    tableAccents["õ"] = "o"
    tableAccents["ö"] = "o"
    tableAccents["ø"] = "o"
    tableAccents["ù"] = "u"
    tableAccents["ú"] = "u"
    tableAccents["û"] = "u"
    tableAccents["ü"] = "u"
    tableAccents["ý"] = "y"
    tableAccents["þ"] = "p"
    tableAccents["ÿ"] = "y"
  local normalisedString = ''
  local normalisedString = str: gsub("[%z\1-\127\194-\244][\128-\191]*", tableAccents)
  return normalisedString
end

local generator = {}

local NumeroDeProcedimentos = 6

local Nomes = {'Abraão', 'Adão', 'Allan', 'Amado', 'Ana', 'Antônio', 'Airton', 'André', 'Armando', 'Arthur', 'Augusto', 'Beatriz', 'Caio', 'Carlos', 'Diego', 'Dolores', 'Eduarda', 'Eduardo' ,'Elbelébio', 'Eustáquio','Eva', 'Fernanda', 'Gabriel', 'Guilherme', 'Gustavo','Helena', 'Henrique', 'Isabela', 'Isadora', 'Jacinto', 'Jefferson', 'João', 'Joel', 'Jorge', 'Júlia', 'Laura', 'Lucas', 'Luísa', 'Maria', 'Milena', 'Matheus', 'Napoleão', 'Nilton', 'Olga', 'Omar', 'Paula', 'Pedro', 'Ramon', 'Rita', 'Roberto', 'Samara', 'Tatiana', 'Ulisses', 'Vicente', 'Victor'}
local Sobrenomes = {'Alves', 'Amaral', 'Andrade', 'de Araújo', 'Batista', 'Belso', 'Borges', 'Bonaparte', 'Caram', 'Campos', 'Carvalho', 'Costa', 'Dias', 'Gomes', 'Guerra', 'Júnior', 'Lacerda', 'Lima', 'Lopes', 'Luz', 'Maia', 'Machado', 'Marques', 'Melo', 'Miranda', 'Monteiro', 'Morais', 'Nascimento', 'Oliveira', 'Reis', 'Penha', 'Pereira', 'Pimentel', 'Pinto', 'Prado', 'Procópio', 'da Rocha', 'Ramos', 'Ribeiro', 'Rolando', 'Salgado', 'Santana', 'Senna', 'dos Santos', 'da Silva', 'Souza', 'Tavares', 'Terra', 'Vieira'}
local Estado = {'BA', 'DF', 'MG', 'RJ', 'SP'}
local Rua = {'Rua', 'Alameda', 'Avenida', 'Estrada'}
local Cidade = {'Recanto', 'Vila', 'Monte', 'Vale', 'Cidade', 'Riacho'}
local Sobrelugar = {'das Araras', 'das Almas', 'das Bananeiras', 'das Laranjeiras', 'das Macieiras', 'das Andorinhas', 'das Pedras', 'dos Urubus', 'dos Alfaiates', 'dos Dentistas', 'dos Engenheiros', 'dos Advogados', 'dos Diamantes', 'dos Rubis', 'dos Almoxarifados', 'Grande', 'do Sol', 'da Lua', 'do Ouro', 'da Prata'}
local Complemento = {'"Casa"', '"Apartamento"', '"Sobrado"', 'null', 'null', 'null'}

function generator.cliente(TotalClientes, sub)
  local idx = 1
  if sub then idx = TotalClientes end
  for i=idx,TotalClientes do
    local Nome = Nomes[math.random(#Nomes)]
    local Sob1 = Sobrenomes[math.random(#Sobrenomes)]
    local Sob2 = Sobrenomes[math.random(#Sobrenomes)]
    local Estado = Estado[math.random(#Estado)]
    local Cliente = string.format('$Cliente%d = new Cliente("%s %s %s", "%s-%02d.%03d.%03d", "%s%s@gmail.com", 9%08d, "%011d");\n', i, Nome, Sob1, Sob2, Estado, math.random(0,99), math.random(0,999), math.random(0,999), removeAcento(Nome:lower()), removeAcento(Sob2:lower():gsub("%s+","")), math.random(0,99999999), math.random(0,99999999999))
    print(Cliente)
    if sub then return idx end
  end
end

function generator.endereco(i)
  local Estado = Estado[math.random(#Estado)]
  local Cidade1 = Cidade[math.random(#Cidade)]
  local Cidade2 = Sobrelugar[math.random(#Sobrelugar)]
  if (math.random(1,10) < 2) then
      Cidade2 = Sobrenomes[math.random(#Sobrenomes)]
  end
 local Bairro = Sobrelugar[math.random(#Sobrelugar)]
  if (math.random(1,10) < 2) then
    Bairro = Nomes[math.random(#Nomes)] .. ' ' .. Sobrenomes[math.random(#Sobrenomes)]
  end
  local Rua1 = Rua[math.random(#Rua)]
  local Rua2 = Sobrelugar[math.random(#Sobrelugar)]
  if (math.random(1,10) < 2) then
      Rua2 = Nomes[math.random(#Nomes)] .. ' ' .. Sobrenomes[math.random(#Sobrenomes)]
  end
  local Complemento = Complemento[math.random(#Complemento)]
  
  local Endereco = string.format('$Endereco%d = new Endereco("%s", "%s %s", "Bairro %s", "%s %s", %d, %s);\n', i, Estado, Cidade1, Cidade2, Bairro, Rua1, Rua2, math.random(1,999), Complemento)
  print (Endereco)
  return (string.format("Endereco%s",i))
end

function generator.funcionario(TotalFuncionario, Cargo)
  for i=1,TotalFuncionario do
    local Nome = Nomes[math.random(#Nomes)]
    local Sob1 = Sobrenomes[math.random(#Sobrenomes)]
    local Sob2 = Sobrenomes[math.random(#Sobrenomes)]
    local Estado = Estado[math.random(#Estado)]
    local Funcionario = string.format('$Funcionario%d = new Funcionario("%s %s %s", "%s-%02d.%03d.%03d", "%s%s@gmail.com", 9%08d, "%011d", $%s, %d, null, "%s");\n', i, Nome, Sob1, Sob2, Estado, math.random(0,99), math.random(0,999), math.random(0,999), removeAcento(Nome:lower()), removeAcento(Sob2:lower():gsub("%s+","")), math.random(0,99999999), math.random(0,99999999999), generator.endereco(i), math.random(30,100)*50, Cargo)
    print (Funcionario)
    if sub then return idx end
  end
end

function generator.dentista(TotalDentista, Parceiro, sub)
  local idx = 1
  if sub then idx = TotalDentista end
  if Parceiro then Parceiro = "Parceiro" else Parceiro = "" end
  for i=idx,TotalDentista do
    local Nome = Nomes[math.random(#Nomes)]
    local Sob1 = Sobrenomes[math.random(#Sobrenomes)]
    local Sob2 = Sobrenomes[math.random(#Sobrenomes)]
    local Estado = Estado[math.random(#Estado)]
    local Dentista = string.format('$Dentista%d = new Dentista%s("%s %s %s", "%s-%02d.%03d.%03d", "%s%s@gmail.com", 9%08d, "%011d", $%s, %d, "CRO-%s %d", array(Especialidade::getRecords()[%d]));\n', i, Parceiro, Nome, Sob1, Sob2, Estado, math.random(0,99), math.random(0,999), math.random(0,999), removeAcento(Nome:lower()), removeAcento(Sob2:lower():gsub("%s+","")), math.random(0,99999999), math.random(0,99999999999), generator.endereco(i), 5000, Estado, math.random(0,9999), math.random(0,4))
    print (Dentista)
    if sub then return idx end
  end
end

function generator.paciente(TotalPaciente, sub)
  local idx = 1
  if sub then idx = TotalPaciente end
  for i=idx,TotalPaciente do
    local Nome = Nomes[math.random(#Nomes)]
    local Sob1 = Sobrenomes[math.random(#Sobrenomes)]
    local Sob2 = Sobrenomes[math.random(#Sobrenomes)]
    local Estado = Estado[math.random(#Estado)]
    local Paciente = string.format('$Paciente%d = new Paciente("%s %s %s", "%s-%02d.%03d.%03d", "%s%s@gmail.com", 9%08d, "%011d", $Cliente%d);\n', i, Nome, Sob1, Sob2, Estado, math.random(0,99), math.random(0,999), math.random(0,999), removeAcento(Nome:lower()), removeAcento(Sob2:lower():gsub("%s+","")), math.random(0,99999999), math.random(0,99999999999), generator.cliente(i, true))
    print(Paciente)
    if sub then return idx end
  end
end

function generator.consulta(TotalConsulta, MesmoPaciente, Parceiro, sub)
  local idx = 1
  if sub then idx = TotalConsulta end
  
  local Paciente = false;
  if MesmoPaciente then
    Paciente = generator.paciente(1, true)
  end
  
  for i=idx,TotalConsulta do
    local Consulta = string.format('$Consulta%d = new Consulta($Paciente%d, $Dentista%s%d, %d%02d%02d, "%02d:%02d", %d);\n', i, Paciente and 1 or generator.paciente(i, true), Parceiro and Parceiro or '', generator.dentista(i, Parceiro, true), math.random(2022,2023), math.random(0,12), math.random(0,31), math.random(8,18), math.random(0,5)*10, math.random(2,12) * 10)
    print(Consulta)
    if sub then return idx end
  end
end
  
return generator