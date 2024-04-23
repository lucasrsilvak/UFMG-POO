<?php
  class UsuarioLogado extends Usuario {
    static string $local_filename = "UsuarioLogado.txt";
    static private $ptr_container = null;
    
    protected ?Usuario $Usuario = null;
    
    public function __construct() {}

    // Singleton
    
    static function getInstance() {
        if (self::$ptr_container == null) {
          self::$ptr_container = new self();
        }
        return self::$ptr_container;
    }

    // Getters
    public function getUsuario() {
      return $this->Usuario;
    }
    
    // Setters
    public function setUsuario($Usuario) {
      $this->Usuario = $Usuario;
    }

    // Métodos

    public function logar($Login, $Senha) {
      foreach(Usuario::getRecords() as $Usuario) {
        if ($Usuario->getLogin() == $Login && $Usuario->getSenha() == $Senha) {
          $UsuarioLogado = UsuarioLogado::getInstance();
          $UsuarioLogado->setUsuario($Usuario);
          $UsuarioLogado->save();

          $Usuario->setLogado(true);
          $this->Usuario->save();

          echo "[" . date('H:i') . "] [Sistema] " . $Usuario->getLogin() . " conectou-se ao sistema.\n";
        }
      }
    }
    
    public function deslogar() {
      $UsuarioLogado = UsuarioLogado::getInstance();
      
      $UsuarioLogado->getUsuario()->setLogado(false);
      $UsuarioLogado->getUsuario()->save();

      echo "[" . date('H:i') . "] [Sistema] " . $this->Usuario->getLogin() . " desconectou-se do sistema.\n";
      
      $UsuarioLogado->setUsuario(null);
      $UsuarioLogado->save();
    }

    // Listar
    public static function getAtributos($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
          "Não Implementado"
        ];
      }
    }

    public function getDados($Class) {
      if(self::class === $Class || is_subclass_of(self::class, $Class)) {
        return [
        ];
      }
    }
    
    // Hooks
    static public function getFilename(){
      return get_called_class()::$local_filename;
    }
  }
?>