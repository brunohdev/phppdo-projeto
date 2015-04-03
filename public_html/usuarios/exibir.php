<?php

use Escola\UsuarioRepository;
use Escola\UsuarioService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$usuario = new UsuarioRepository();

$service = new UsuarioService($db->getPdo(), $usuario);

$resultado = $service->find($id);

echo $resultado['nome']." - Login: <strong>".$resultado['login']."</strong><br/>";

echo "<br/><a href=\"/usuarios\">Voltar</a>";