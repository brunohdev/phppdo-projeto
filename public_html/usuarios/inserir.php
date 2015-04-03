<?php

use Escola\UsuarioRepository;
use Escola\UsuarioService;
use Escola\Database;

$db = new Database(include __DIR__."/../../config.php");

$usuario = new UsuarioRepository();

$service = new UsuarioService($db->getPdo(), $usuario);

echo "<form method='POST'>";
echo "Nome: <input type='text' name='nome'/> ";
echo "Login: <input type='text' name='login'/> ";
echo "Senha: <input type='password' name='senha'/> ";
echo "<input type='submit' name='enviar' value='Inserir'/>";
echo "</form>";

if (isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    $salt = "akeaokea.e19231;aejaojeoasije2u39123"; // SALT GERAL
    $salt_unico = "fadasas6165165"; // SALT ÚNICO

    $senha_sha1 = sha1($senha.$salt.$salt_unico);

    $usuario->setNome($nome)
            ->setLogin($login)
            ->setSenha($senha_sha1)
    ;

    $resultado = $service->inserir();

    if ($resultado) {
        header("Location: /usuarios");
    }
}

echo "<br/><a href='/usuarios'>Voltar</a>";