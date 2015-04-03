<?php

namespace Escola;

class AlunoRepository
{
    private $id;
    private $nome;
    private $nota;
    
    
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