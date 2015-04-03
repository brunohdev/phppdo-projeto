<?php

use Escola\AlunoRepository;
use Escola\AlunoService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$aluno = new AlunoRepository();

$service = new AlunoService($db->getPdo(), $aluno);

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

    $resultado = $service->inserir();

    if ($resultado) {
        header("Location: /alunos");
    }
}

echo "<br/><a href='/alunos'>Voltar</a>";