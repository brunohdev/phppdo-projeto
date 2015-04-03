<?php

use Escola\AlunoRepository;
use Escola\AlunoService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$aluno = new AlunoRepository();

$service = new AlunoService($db->getPdo(), $aluno);

$resultado = $service->find($id);

echo $resultado['nome']." - Nota: <strong>".$resultado['nota']."</strong><br/>";

echo "<br/><a href=\"/alunos\">Voltar</a>";