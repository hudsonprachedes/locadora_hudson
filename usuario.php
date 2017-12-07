<?php
session_start();
if (!isset($_SESSION['s_login'])) {
    header('location: login.php');
    die;
}
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

        <title>Locadora X  - CRUD</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link href="css/theme.css" rel="stylesheet">
        <script src="js/ie-emulation-modes-warning.js"></script>
    </head>

    <body role="document">

        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="administrativo.php">Administrativo Locadora</a>

                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="cliente.php">Clientes</a></li>
                        <li><a href="filme.php">Filmes</a></li> 
                        <li><a href="locacao.php">Locação</a></li>
                        <li><a>Usuários</a></li>  
                        <li><a href="sair.php">Sair</a></li>
                    </ul>
                </div><!--/.nav-collapse -->

            </div>                
        </div>
    </nav>
    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <br>
            <h1>Inserir Usuario</h1>
            <h4>Aqui você pode inserir um Usuario a Locadora X - CRUD.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <form name="dadosUsuarios" action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Nome</th>
                                <th>Login</th>
                                <th>Senha</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>  


                        <td><input type="text" name="nome"  placeholder="Nome" value="" class="form-control" /></td>
                        <td> <input type="text" name="login" id="login" placeholder="Digite um Login" class="form-control"><br></td>
                        <td><input type="password" name="senha" id="senha" placeholder="Digite sua senha" class="form-control"><br></td>
                        <input type="hidden" name="acao" value="inserir" />
                        <td><input type="submit" value="inserir" class="btn btn-xs btn-success"> </td>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <br>
            <h1>Editar Usuario</h1>
            <h4>Aqui você pode Editar um Usuario a Locadora X - CRUD.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <form name="dadosUsuarios" action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Nome</th>
                                <th>Login</th>
                                <th>Senha</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>  
                        <input type="hidden" name="codigo" class="form-control" value="<?php
                        if (isset($_POST["editar"])) {
                            echo $_POST["codigo"];
                        }
                        ?>"/>

                        <td> <input type="text" name="nome"  class="form-control" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["nome"];
                            }
                            ?>"><br></td>

                        <td> <input type="text" name="login"  class="form-control" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["login"];
                            }
                            ?>"><br></td>
                        <td><input type="password" name="senha"  class="form-control" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["senha"];
                            }
                            ?>"><br></td>
                        <input type="hidden" name="acao" value="editar" />
                        <td><input type="submit" value="Alterar" class="btn btn-xs btn-success"> </td>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>


    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <br>
            <br>

            <h1>Usuarios</h1>


        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Senha</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($_SESSION['usuario'])) {
                            header('location: login.php');
                            die;
                        }
                        $controle = true;
                        $cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "inserir"):
                                $registro = array("codigo" => count($_SESSION["usuario"]) + 1, "nome" => $cadastro["nome"], "login" => $cadastro["login"], "senha" => $cadastro["senha"]);
                                foreach ($_SESSION["usuario"] as $key => $value) {
                                    
                                }
                                if ($_POST["login"] != $value["login"]):
                                    array_push($_SESSION['usuario'], $registro);
                                    echo '<div class = "alert alert-success" role = "alert"><strong>SUCESSO</strong> Cadastro efetuado.</div>';
                                else:
                                    echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> Cadastro Igual.</div>';
                                endif;
                            endif;
                        }
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "excluir") {
                                $array = [];
                                foreach ($_SESSION["usuario"] as $key => $value) {
                                    if (intval($cadastro["codigo"]) != $value["codigo"]) :
                                        array_push($array, $value);
                                    endif;
                                }
                                $_SESSION["usuario"] = $array;
                                echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> Cadastro Excluído.</div>';
                            }
                        }
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "editar") {
                                foreach ($_SESSION["usuario"] as $key => $value) :
                                    if (($_POST["login"] != $value["login"] && (intval($cadastro["codigo"]) === $value["codigo"])) == true) :
                                        $_SESSION["usuario"][$key]['nome'] = $cadastro['nome'];
                                        $_SESSION["usuario"][$key]['login'] = $cadastro['login'];
                                        $_SESSION["usuario"][$key]['senha'] = $cadastro['senha'];

                                        echo '<div class = "alert alert-success" role = "alert"><strong>SUCESSO</strong> Cadastro Alterado.</div>';
                                    else:
                                        
                                    endif;
                                endforeach;
                            }
                        }

                        foreach ($_SESSION['usuario'] as $key => $value) {
                            echo "<tr>
                                    <td>{$value['codigo']}</td>
                                    <td>{$value['nome']}</td>
                                    <td>{$value['login']}</td>
                                    <td>{$value['senha']}</td>
                                    <td>                 
                                        <form name='editar' action='' method='POST'>
                                            <input type='hidden' name='codigo' value='{$value['codigo']}' />
                                            <input type='hidden' name='nome' value='{$value['nome']}' />
                                            <input type='hidden' name='login' value='{$value['login']}' />
                                            <input type='hidden' name='senha' value='{$value["senha"]}'/>
                                            <input type='submit' value='Editar' name='editar' class='btn btn-xs btn-warning'/>                                        
                                        </form>
                                    </td>
                                    <td>
                                        <form name='excluir' action='' method='POST'>
                                            <input type='hidden' name='codigo' id='codigo' value='{$value['codigo']}'/>
                                            <input type='hidden' name='acao' value='excluir'/>
                                            <input type='submit' name='btn_excluir' value='excluir' class='btn btn-xs btn-danger'/>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>');</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
