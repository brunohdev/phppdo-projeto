<?php

namespace Escola;

class AlunoService
{
    private $db;
    private $aluno;

    public function __construct(\PDO $db, AlunoRepository $aluno)
    {
        $this->db = $db;
        $this->aluno = $aluno;
    }
    
    public function find($id)
    {
        $query = "SELECT * FROM alunos WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function buscarPorNome($nome)
    {
        $nome = "%".$nome."%";
        $query = "SELECT id, nome FROM alunos WHERE nome LIKE :nome";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function listar()
    {
        $query = "SELECT id, nome FROM alunos";
        $stmt = $this->db->query($query);
        
        return $stmt->fetchAll(); // Traz os dados
    }
    
    public function inserir()
    {
        $query = "INSERT INTO alunos (nome, nota) VALUES (:nome, :nota)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->aluno->getNome());
        $stmt->bindValue(':nota', $this->aluno->getNota());
        
        if ($stmt->execute()) {
            return true;
        }
    }
    
    public function alterar()
    {
        $query = "UPDATE alunos SET nome=:nome, nota=:nota WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->aluno->getId());
        $stmt->bindValue(':nome', $this->aluno->getNome());
        $stmt->bindValue(':nota', $this->aluno->getNota());
        
        if ($stmt->execute()) {
            return true;
        }
    }
    
    public function remover($id)
    {
        $query = "DELETE FROM alunos WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
    }
}