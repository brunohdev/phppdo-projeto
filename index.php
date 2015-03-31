<?php

require_once 'Aluno.php';

try {
    $conexao = new \PDO("mysql:host=localhost;dbname=pdo", "root", "");
}
catch (Exception $e) {
    die("Não foi possível estabelecer a coneão com o banco de dados. Erro: ".$e->getCode());
}

$aluno = new Aluno($conexao);


if (isset($_GET['ver'])) {
    
    $id = $_GET['ver'];
    
    $resultado = $aluno->find($id);
    echo $resultado['nome']." - Nota: <strong>".$resultado['nota']."</strong> - <a href='./'>Voltar</a>";
    
}
else if (isset($_GET['inserir'])) {
    
    echo "<form method='POST'>";
    echo "Nome: <input type='text' name='nome'/> ";
    echo "Nota: <input type='text' name='nota'/> ";
    echo "<input type='submit' name='enviar' value='Inserir'/>";
    echo "</form>";
    
    if (isset($_POST['enviar'])){
        $nome = $_POST['nome'];
        $nota = $_POST['nota'];
    
        $aluno->setNome($nome)
              ->setNota($nota)
        ;
        
        $resultado = $aluno->inserir();
        
        if ($resultado) {
            header("Location: ./");
        }
    }
    
    echo "<br/><br/><a href='./'>Voltar</a>";
    
}
else if (isset($_GET['alterar'])) {
    
    $id = $_GET['alterar'];
    
    $resultado = $aluno->find($id);
    
    echo "<form method='POST'>";
    echo "Nome: <input type='text' name='nome' value='{$resultado['nome']}'/> ";
    echo "Nota: <input type='text' name='nota' value='{$resultado['nota']}'/> ";
    echo "<input type='hidden' name='id' value='{$id}'/>";
    echo "<input type='submit' name='enviar' value='Alterar'/>";
    echo "</form>";
    
    if (isset($_POST['enviar'])){
        $id   = $_POST['id'];
        $nome = $_POST['nome'];
        $nota = $_POST['nota'];
    
        $aluno->setId($id)
              ->setNome($nome)
              ->setNota($nota)
        ;
        
        $resultado = $aluno->alterar();
        
        if ($resultado) {
            header("Location: ./");
        }
    }
    
    echo "<br/><br/><a href='./'>Voltar</a>";
    
}
else if (isset($_GET['deletar'])) {
    
    $id = $_GET['deletar'];
    
    $resultado = $aluno->deletar($id);
    echo "Aluno deletado com sucesso! - <a href='./'>Voltar</a>";
    
}
else {
    
    echo "<a href='?inserir'>Inserir</a><br/><hr/>";

    // LISTAR
    foreach ($aluno->listar() as $c) {
        echo $c['nome']." - ";
        echo "<a href='?ver={$c['id']}'>Ver</a> - <a href='?alterar={$c['id']}'>Alterar</a> - <a href='?deletar={$c['id']}'>Deletar</a>";
        echo "<br/>------------------------------------------------<br/>";
    }

}