<?php

try {
    $conexao = new \PDO("mysql:host=localhost;dbname=pdo", "root", "");
    
    $query = "SELECT * FROM alunos";
    $stmt = $conexao->query($query);
    $resultado = $stmt->fetchAll(PDO::FETCH_CLASS);
    
    foreach ($resultado as $aluno) {
        echo $aluno->nome." - <strong>".$aluno->nota."</strong><br/>";
    }
    
    echo "=====================================<br/>";
    
    $query = "SELECT * FROM alunos ORDER BY nota DESC, id LIMIT 3";
    $stmt = $conexao->query($query);
    $resultado = $stmt->fetchAll(PDO::FETCH_CLASS);
    
    foreach ($resultado as $aluno) {
        echo $aluno->nome." - <strong>".$aluno->nota."</strong><br/>";
    }
}
catch (\PDOException $e) {
    echo "Não foi possível estabelecer a conexão com o banco de dados. Erro: ".$e->getCode();
}