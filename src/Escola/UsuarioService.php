<?php

namespace Escola;

class UsuarioService
{
    private $db;
    private $usuario;

    public function __construct(\PDO $db, UsuarioRepository $usuario)
    {
        $this->db = $db;
        $this->usuario = $usuario;
    }
    
    public function find($id)
    {
        $query = "SELECT id, nome, login FROM usuarios WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function listar()
    {
        $query = "SELECT id, nome, login FROM usuarios";
        $stmt = $this->db->query($query);
        
        return $stmt->fetchAll(); // Traz os dados
    }
    
    public function inserir()
    {
        $query = "INSERT INTO usuarios (nome, login, senha) VALUES (:nome, :login, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->usuario->getNome());
        $stmt->bindValue(':login', $this->usuario->getLogin());
        $stmt->bindValue(':senha', $this->usuario->getSenha());
        
        if ($stmt->execute()) {
            return true;
        }
    }
    
    public function alterar()
    {
        if ($this->usuario->getSenha()) {
            $query = "UPDATE usuarios SET nome=:nome, login=:login, senha=:senha WHERE id=:id";
        }
        else {
            $query = "UPDATE usuarios SET nome=:nome, login=:login  WHERE id=:id";
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->usuario->getId());
        $stmt->bindValue(':nome', $this->usuario->getNome());
        $stmt->bindValue(':login', $this->usuario->getLogin());
        
        if ($this->usuario->getSenha()) {
            $stmt->bindValue(':senha', $this->usuario->getSenha());
        }
        
        if ($stmt->execute()) {
            return true;
        }
    }
    
    public function remover($id)
    {
        $query = "DELETE FROM usuarios WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
    }
}