<?php

use Escola\UsuarioRepository;
use Escola\UsuarioService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$usuario = new UsuarioRepository();

$service = new UsuarioService($db->getPdo(), $usuario);

$resultado = $service->find($id);

echo "<form method='POST'>";
echo "Nome: <input type='text' name='nome' value='{$resultado['nome']}'/> ";
echo "Login: <input type='text' name='login' value='{$resultado['login']}'/> ";
echo "Nova Senha: <input type='password' name='senha' /> ";
echo "<input type='hidden' name='id' value='{$id}'/>";
echo "<input type='submit' name='enviar' value='Alterar'/>";
echo "</form>";

if (isset($_POST['enviar'])){
    $id   = $_POST['id'];
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $usuario->setId($id)
            ->setNome($nome)
            ->setLogin($login)
            ->setSenha($senha_hash)
    ;

    $resultado = $service->alterar();

    if ($resultado) {
        header("Location: /usuarios");
    }
}

echo "<br/><a href='/usuarios'>Voltar</a>";