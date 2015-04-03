<?php

use Escola\UsuarioRepository;
use Escola\UsuarioService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$usuario = new UsuarioRepository();

$service = new UsuarioService($db->getPdo(), $usuario);

$resultado = $service->remover($id);
echo "Usuario removido com sucesso!";
echo "<br/><br/><a href='/usuarios'>Voltar</a>";