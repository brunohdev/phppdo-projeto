<?php

class Aluno
{
    private $db;
    
    private $id;
    private $nome;
    private $nota;
    
    
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
    
    public function find($id)
    {
        $query = "SELECT * FROM alunos WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function listar($ordem = null)
    {
        if ($ordem) {
            $query = "SELECT * FROM alunos ORDER BY {$ordem}";
        }
        else {
            $query = "SELECT * FROM alunos";
        }
        
        $stmt = $this->db->query($query);
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function inserir()
    {
        $query = "INSERT INTO alunos (nome, nota) VALUES (:nome, :nota)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->getNome());
        $stmt->bindValue(':nota', $this->getNota());
        
        if ($stmt->execute()) {
            return true;
        }
    }
    
    public function alterar()
    {
        $query = "UPDATE alunos SET nome=:nome, nota=:nota WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->getId());
        $stmt->bindValue(':nome', $this->getNome());
        $stmt->bindValue(':nota', $this->getNota());
        
        if ($stmt->execute()) {
            return true;
        }
    }
    
    public function deletar($id)
    {
        $query = "DELETE FROM alunos WHERE id=:id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
    }
    
    // GETTERS AND SETTERS
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getNota() {
        return $this->nota;
    }

    public function setId($id) {
        $this->id = $id;
        return $this; // Fluente
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this; // Fluente
    }

    public function setNota($nota) {
        $this->nota = $nota;
        return $this; // Fluente
    }
}