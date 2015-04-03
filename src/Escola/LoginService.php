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
        $salt = "akeaokea.e19231;aejaojeoasije2u39123"; // SALT GERAL
        $salt_unico = "fadasas6165165"; // SALT ÚNICO

        $senha_sha1 = sha1($senha.$salt.$salt_unico);
        
        $query = "SELECT id, nome FROM usuarios WHERE login=:login AND senha=:senha LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':senha', $senha_sha1);
        $stmt->execute();
        
        return $stmt->fetch();
    }
}