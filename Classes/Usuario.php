<?php
  class Usuario extends persist {
    static string $local_filename = "Usuario.txt";

    protected ?ControleDeAcesso $Controle;
    protected string $Email;
    protected string $Login;
    protected string $Senha;
    protected bool   $Logado;

    public function __construct($Login, $Senha, $Email, $Controle = null) {
      $this->Login = $Login;
      $this->Senha = $Senha;
      $this->Email = $Email;
      $this->Controle = $Controle;
      $this->Logado = false;

      $this->save();
      Logger::logMessage($Login, $this);
    }

    // Getters
    public function getLogin() {
      return $this->Login;
    }
    public function getSenha() {
      return $this->Senha;
    }
    public function getEmail() {
      return $this->Email;
    }
    public function getControle() {
      return $this->Controle;
    }
    public function getLogado() {
      return $this->Logado;
    }
    
    // Setters
    public function setLogin($Login){
      $this->Login = $Login;
    }
    public function setSenha($Senha){
      $this->Senha = $Senha;
    }
    public function setEmail($Email) {
      $this->Email = $Email;
    }
    public function setControle($Controle) {
      $this->Controle = $Controle;
    }
    public function setLogado($Logado){
      $this->Logado = $Logado;
    }

    // Métodos 

    //Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Usuario",
          "Email",
          "Senha",
          "Controle"
        ];
      }
    }

    public function getDados($Class) {
      if(get_class($this) === $Class || is_subclass_of($this, $Class)) {
        return [
          $this->Login,
          $this->Email,
          $this->Senha,
          $this->Controle->getTipo()
        ];  
      }
    }

    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>
