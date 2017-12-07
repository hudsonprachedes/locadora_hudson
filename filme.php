<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['s_login'])) {
    header('location: login.php');
    die;
}

if (isset($_SESSION['filme'])) {
    goto in_serir;
    die;
}
$_SESSION['filme'] = array(
    array(
        "codigo" => "1",
        "nome" => "Filme##1",
        "produtora" => "produtora##1",
        "distribuidora" => "distribuidora##1"
    ),
    array(
        "codigo" => "2",
        "nome" => "Filme##2",
        "produtora" => "produtora##2",
        "distribuidora" => "distribuidora##2"
    ),
    array(
        "codigo" => "3",
        "nome" => "Filme##3",
        "produtora" => "produtora##3",
        "distribuidora" => "distribuidora##3"
    ),
    array(
        "codigo" => "4",
        "nome" => "Filme##4",
        "produtora" => "produtora##4",
        "distribuidora" => "distribuidora##4"
    )
);
in_serir:
?>

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
                        <li><a> Filmes </a></li>
                        <li><a href="locacao.php">Locação</a></li>
                        <li><a href="usuario.php">Usuários</a></li>  
                        <li><a href="sair.php">Sair</a></li>
                    </ul>
                </div><!--/.nav-collapse -->

            </div>                
        </div>
    </nav>
    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <br>
            <h1>Inserir Filme</h1>
            <h4>Aqui você pode inserir um Filme a Locadora X - CRUD.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <form name="dadosFilmes" action="" method="post">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Nome do Filme</th>
                                <th>Produtora</th>
                                <th>Distribuidora</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>  

                        <td><input type="text" name="nome" value="" /></td>
                        <td><input type="text" name="produtora" value="" /></td>
                        <td><input type="text" name="distribuidora" value="" /></td>

                        <input type="hidden" name="acao" value="inserir" />
                        <td><input type="submit" value="Inserir" class="btn btn-xs btn-success" /></td>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>


    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <br>
            <h1>Editar Filme</h1>
            <h4>Aqui você pode Editar um Filme a Locadora X - CRUD.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <form name="dadosFilmes" action="" method="post">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Nome do Filme</th>
                                <th>Produtora</th>
                                <th>Distribuidora</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>  
                        <input type="hidden" name="codigo" value="<?php
                        if (isset($_POST["editar"])) {
                            echo $_POST["codigo"];
                        }
                        ?>" />
                        <td><input type="text" name="nome" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["nome"];
                            }
                            ?>" /></td>
                        <td><input type="text" name="produtora" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["produtora"];
                            }
                            ?>" /></td>
                        <td><input type="text" name="distribuidora" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["distribuidora"];
                            }
                            ?>" /></td>

                        <input type="hidden" name="acao" value="editar" />
                        <td><input type="submit" value="Alterar" class="btn btn-xs btn-success" /></td>

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

            <h1>Filmes</h1>


        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome do Filme</th>
                            <th>Produtora</th>
                            <th>Distribuidora</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $controle = false;
                        $cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if (!isset($_SESSION['filme'])) {
                            header('location: login.php');
                            die;
                        }
                        if (isset($_POST["acao"])) {
                            if (!empty($_POST["acao"] === "inserir")):
                                $registro = array("codigo" => count($_SESSION["filme"]) + 1, "nome" => $cadastro["nome"], "produtora" => $cadastro["produtora"], "distribuidora" => $cadastro["distribuidora"]);
                                foreach ($_SESSION["filme"] as $key => $value) {
                                }
                                if ($controle != $value["codigo"]):
                                    array_push($_SESSION['filme'], $registro);
                                    echo '<div class = "alert alert-success" role = "alert"><strong>SUCESSO</strong> Cadastro efetuado.</div>';
                                else:
                                    echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> Cadastro Igual.</div>';
                                endif;
                            endif;
                        }
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "excluir") {
                                $array = [];
                                foreach ($_SESSION["filme"] as $key => $value) {
                                    if (intval($cadastro["codigo"]) != $value["codigo"]) :
                                        array_push($array, $value);
                                    endif;
                                }
                                $_SESSION["filme"] = $array;
                                echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> Cadastro Excluído.</div>';
                            }
                        }
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "editar") {
                                foreach ($_SESSION["filme"] as $key => $value) :
                                    if (intval($cadastro["codigo"]) == $value['codigo']) :
                                        $_SESSION["filme"][$key]['nome'] = $cadastro['nome'];
                                        $_SESSION["filme"][$key]['produtora'] = $cadastro['produtora'];
                                        $_SESSION["filme"][$key]['distribuidora'] = $cadastro['distribuidora'];

                                        echo '<div class = "alert alert-success" role = "alert"><strong>SUCESSO</strong> Cadastro Alterado.</div>';
                                    else:
                                    endif;
                                endforeach;
                            }
                        }




                        foreach ($_SESSION['filme'] as $key => $value) {
                            echo "<tr>
                                                 <td>{$value['codigo']}</td>
                                                 <td>{$value['nome']}</td>
                                                 <td>{$value['produtora']}</td>
                                                 <td>{$value['distribuidora']}</td>
                                               <td>                 
                                        <form name='editar' action='' method='POST'>
                                            <input type='hidden' name='codigo' value='{$value['codigo']}' />
                                            <input type='hidden' name='nome' value='{$value['nome']}' />
                                            <input type='hidden' name='produtora' value='{$value['produtora']}' />
                                            <input type='hidden' name='distribuidora' value='{$value["distribuidora"]}'/>
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
