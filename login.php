<?php
session_start();
if (isset($_SESSION['usuario'])) {
    goto in_serir;
    die;
}
$_SESSION['usuario'] = array(
    array(
        "codigo" => "1",
        "nome" => "hudson",
        "login" => "hudson",
        "senha" => "123")
);
in_serir:
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Hudson">
        <link rel="icon" href="imagens/favicon.png">

        <title>Area Restrita</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
        <script src="js/ie-emulation-modes-warning.js"></script>
    </head>

    <body>

        <div class="container">
            <?php
            if (isset($_POST["login"]) && isset($_POST["senha"])):
                $resultado = FALSE;
                foreach ($_SESSION["usuario"] as $key => $value):
                    if ($_POST["login"] === $value["login"] && $_POST["senha"] === $value["senha"]):
                        $resultado = TRUE;
                        $_SESSION['s_login']["codigo"] = $value["codigo"];
                        $_SESSION['s_login']["nome"] = $value["nome"];
                        $_SESSION['s_login']["login"] = $value["login"];
                    endif;
                endforeach;

                if ($resultado):
                    header("Location: administrativo.php");
                else:
                    echo '<div class = "alert alert-warning" role="alert"><strong>ATENÇÃO</strong> Usuário Inválido.</div>';
                endif;
            endif;
            ?>


            <form class="form-signin" method="POST" action="">
                <h2 class="form-signin-heading">Área Restrita</h2>
                <input type="text" id="IDLogin" class="form-control" name="login" placeholder="LOGIN" required autofocus>
                <input type="password" id="IDSenha" class="form-control" name="senha" placeholder="SENHA" required>
                <button class="btn btn-lg btn-danger btn-block" type="submit">Acessar</button>

                </p>
            </form>
        </div> <!-- /container -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
