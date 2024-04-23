package.path = package.path .. ";" .. (debug.getinfo(1, "S").source:match("(.*[\\/])") or "") .. "?.lua"
math.randomseed(os.time())
local generate = require("generator")

--[[
  Criados: Cliente, Endereco, Dentista, Paciente
  Exemplo:
    generate.cliente(n)          n clientes
    generate.dentista(n, p)      p parceiro (t/f)
    generate.consulta(n, m, p)   m mesmo paciente (t/f) | p parceiro (t/f)
    
    generate.consulta(3, true, false)
  Rodar: lua main.lua
]]--

generate.funcionario(2);
