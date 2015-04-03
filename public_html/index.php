<?php
session_start();

require_once __DIR__."/../vendor/autoload.php";

$path = filter_input(INPUT_SERVER, 'REQUEST_URI');

use Escola\UsuarioRepository;
use Escola\LoginService;
use Escola\Database;

$db = new Database(include __DIR__."/../config.php");

$usuario = new UsuarioRepository();

$service = new LoginService($db->getPdo(), $usuario);

?>
<html>
    <head>
        <title>PHP com PDO</title>
    </head>
    <body>
    <?php
        if ($path == "/inicio") {
            require_once __DIR__.'/seguranca.php'; 
            echo "<a href=\"/alunos\">Lista de Alunos</a> | ";
            echo "<a href=\"/usuarios\">Lista de Usuarios</a><br/><br/>";
            echo $_SESSION['usuarioNome']." - <a href=\"/logout\">SAIR</a>";
        }
        else if ($path == "/logout") {
            require_once __DIR__.'/logout.php';   
        }
        else {
            echo "<form method='POST'>";
            echo "Login: <input type='text' name='login'/> ";
            echo "Senha: <input type='password' name='senha'/> ";
            echo "<input type='submit' name='enviar' value='Entrar'/>";
            echo "</form>";

            if (isset($_POST['enviar'])){
                
                $login = $_POST['login'];
                $senha = $_POST['senha'];
                
                $resultado = $service->validar($login, $senha);
                
                if (is_array($resultado)) {
                    $_SESSION['usuarioID'] = $resultado['id'];
                    $_SESSION['usuarioNome'] = $resultado['nome'];
                    
                    header("Location: /inicio");
                }
                else {
                    echo "<br/>Usuario ou senha invalidos!<br/>";
                }
            }
            
            echo "<br/><br/>Login: teste / Senha: teste";
        }
    ?>
    </body>
</html>