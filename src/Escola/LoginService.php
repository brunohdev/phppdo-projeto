<?php

namespace Escola;

class LoginService
{
    private $db;
    private $usuario;

    public function __construct(\PDO $db, UsuarioRepository $usuario)
    {
        $this->db = $db;
        $this->usuario = $usuario;
    }
    
    public function validar($login, $senha)
    {
        $query = "SELECT id, nome, senha FROM usuarios WHERE login=:login LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch();
        
        if ($user) {
            if(password_verify($senha, $user['senha'])) {
                $_SESSION['usuarioID'] = $user['id'];
                $_SESSION['usuarioNome'] = $user['nome'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}