<?php

use Escola\AlunoRepository;
use Escola\AlunoService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$aluno = new AlunoRepository();

$service = new AlunoService($db->getPdo(), $aluno);

echo "<form method='POST'>";
echo "Buscar por Nome: <input type='text' name='nome'/> ";
echo "<input type='submit' name='buscar' value='Buscar'/>";
echo "</form>";
echo "<hr/>";

if (isset($_POST['buscar'])) {
    $nome = $_POST['nome'];
    
    foreach ($service->buscarPorNome($nome) as $a) {
        echo $a['nome']." - ";
        echo "<a href=\"/alunos/exibir?id=".$a['id']."\">Exibir</a> - ";
        echo "<a href=\"/alunos/alterar?id=".$a['id']."\">Alterar</a> - ";
        echo "<a href=\"/alunos/remover?id=".$a['id']."\">Remover</a><br/>";
    }
}
else {
    foreach ($service->listar() as $a) {
        echo $a['nome']." - ";
        echo "<a href=\"alunos/exibir?id=".$a['id']."\">Exibir</a> - ";
        echo "<a href=\"alunos/alterar?id=".$a['id']."\">Alterar</a> - ";
        echo "<a href=\"alunos/remover?id=".$a['id']."\">Remover</a><br/>";
    }
}