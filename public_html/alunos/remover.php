<?php

use Escola\AlunoRepository;
use Escola\AlunoService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$aluno = new AlunoRepository();

$service = new AlunoService($db->getPdo(), $aluno);

$resultado = $service->remover($id);
echo "Aluno removido com sucesso!";
echo "<br/><br/><a href='/alunos'>Voltar</a>";