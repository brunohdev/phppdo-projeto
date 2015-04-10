<?php

use Escola\UsuarioRepository;
use Escola\UsuarioService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$usuario = new UsuarioRepository();

$service = new UsuarioService($db->getPdo(), $usuario);

foreach ($service->listar() as $u) {
    echo $u['nome']." - ";
    echo "<a href=\"usuarios/exibir?id=".$u['id']."\">Exibir</a> - ";
    echo "<a href=\"usuarios/alterar?id=".$u['id']."\">Alterar</a>";
    if ($_SESSION['usuarioID'] != $u['id']) {
        echo " - <a href=\"usuarios/remover?id=".$u['id']."\">Remover</a><br/>";
    }else{
        echo "<br/>";
    }
}