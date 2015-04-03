<?php

use Escola\AlunoRepository;
use Escola\AlunoService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$aluno = new AlunoRepository();

$service = new AlunoService($db->getPdo(), $aluno);

$resultado = $service->find($id);

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

    $resultado = $service->alterar();

    if ($resultado) {
        header("Location: /alunos");
    }
}

echo "<br/><a href='/alunos'>Voltar</a>";