<?php
session_start();
require_once __DIR__.'/../seguranca.php'; 

require_once __DIR__."/../../vendor/autoload.php";

$path = filter_input(INPUT_SERVER, 'REQUEST_URI');

$id = filter_input(INPUT_GET, 'id');
$nome = filter_input(INPUT_GET, 'nome');

?>
<html>
    <head>
        <title>PHP com PDO</title>
    </head>
    <body>
    <?php
        if ($path == "/alunos") {
            echo "<a href=\"/inicio\">Voltar</a>";
            echo "<hr/>";
            echo "<a href=\"/alunos/novo\">INSERIR NOVO ALUNO</a>";
            echo "<hr/>";
            require_once __DIR__.'/listar.php';
        }
        else if ($path == "/alunos/novo") {
            require_once __DIR__.'/inserir.php';
        }
        else if ($path == "/alunos/exibir?id=$id") {
            require_once __DIR__.'/exibir.php';
        }
        else if ($path == "/alunos/alterar?id=$id") {
            require_once __DIR__.'/alterar.php';
        }
        else if ($path == "/alunos/remover?id=$id") {
            require_once __DIR__.'/remover.php';
        }
    ?>
    </body>
</html>