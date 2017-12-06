<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['s_login'])) {
    header('location: login.php');
    die;
}

if (isset($_SESSION['locacao'])) {
    goto in_serir;
    die;
}
$_SESSION['locacao'] = array(
    array(
        "select" => "Hudson",
        "selectt" => "Filme#1",
        "datalocacao" => "10/11/2017",
        "datadevolucao" => "13/11/2017",
        "valor" => "123"
    ),
    array(
        "select" => "Fulano",
        "selectt" => "Filme#2",
        "datalocacao" => "10/11/2017",
        "datadevolucao" => "5/12/2017",
        "valor" => "13"
    ),
    array(
        "select" => "Ciclano",
        "selectt" => "Filme#3",
        "datalocacao" => "5/10/2017",
        "datadevolucao" => "13/10/2017",
        "valor" => "12"
    ),
    array(
        "select" => "Beltrano",
        "selectt" => "Filme#4",
        "datalocacao" => "01/11/2017",
        "datadevolucao" => "15/11/2017",
        "valor" => "33"
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
                        <li><a href="filme.php">Filmes</a></li> 
                        <li><a>Locação</a></li>
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
            <h1>Inserir Locação</h1>
            <h4>Aqui você pode inserir uma Locação à Locadora X - CRUD.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <form name="dadosLocacao" action="" method="POST">
                    <table class="table">

                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Filme locado</th>
                                <th>Data da Locação</th>
                                <th>Data da devolução</th>
                                <th>Valor da Locação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <td><select name="select">
                                <option value="">Selecionar Cliente</option>
                                <?php
                                foreach ($_SESSION["cliente"] as $key => $value) {
                                    echo "<option value='{$value["nomec"]}'>{$value["nomec"]}</option>";
                                }
                                ?>
                            </select> </td>
                        <td><select name="selectt">
                                <option value="">Selecionar Filme</option>
                                <?php
                                foreach ($_SESSION["filme"] as $key => $value) {
                                    echo "<option value='{$value["nome"]}'>{$value["nome"]}</option>";
                                }
                                ?>
                            </select> </td>
                        <td><input type="date" name="datalocacao" value="" /></td>
                        <td><input type="date" name="datadevolucao" value="" /></td>
                        <td><input type="int" name="valor" value="" /></td>

                        <input type="hidden" name="acao" value="inserir" />
                        <td><input type="submit" value="Enviar" class="btn btn-xs btn-success" /></td>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>


    <div class="container theme-showcase" role="main">
        <div class="page-header">
            <br>
            <h1>Editar Locação</h1>
            <h4>Aqui você pode Editar a Locação.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <form name="dadosFilmes" action="" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Filme locado</th>
                                <th>Data da Locação</th>
                                <th>Data da devolução</th>
                                <th>Valor da Locação</th>

                            </tr>
                        </thead>
                        <tbody>  
                        <td><select name="select">
                                <option value="">Selecionar Cliente</option>
                                <?php
                                if (isset($_POST["editar"])) {
                                    echo $_POST["select"];
                                }
                                foreach ($_SESSION["cliente"] as $key => $value) {
                                    echo "<option value='{$value["codigo"]}'>{$value["nomec"]}</option>";
                                }
                                ?>
                            </select> </td>
                        <td><select name="selectt">
                                <option value="">Selecionar Filme</option>
                                <?php
                                if (isset($_POST["editar"])) {
                                    echo $_POST["selectt"];
                                }
                                foreach ($_SESSION["filme"] as $key => $value) {
                                    echo "<option value='{$value["codigo"]}'>{$value["nome"]}</option>";
                                }
                                ?>
                            </select> </td>
                        <td><input type="date" name="datalocacao" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST['datalocacao'];
                            }
                            ?>" /></td>
                        <td><input type="date" name="datadevolucao" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["datadevolucao"];
                            }
                            ?>" /></td>
                        <td><input type="int" name="valor" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["valor"];
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

            <h1>Locação</h1>



        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Cliente</th>
                            <th>Filme locado</th>
                            <th>Data da Locação</th>
                            <th>Data da devolução</th>
                            <th>Valor da Locação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "inserir") {
                                array_push($_SESSION['locacao'], $_POST);
                            }
                        }
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "excluir") {
                                $array = [];
                                foreach ($_SESSION["locacao"] as $key => $value) {
                                    if (intval($cadastro["select"]) != $value["select"]) {
                                        array_push($array, $value);
                                    }
                                }
                                $_SESSION["locacao"] = $array;
                            }
                        }
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "editar") {
                                    foreach ($_SESSION["locacao"] as $key => $value) {
                                        if (intval($cadastro["select"]) == $value['select']) {
                                            $_SESSION["locacao"][$key]['select'] = $cadastro['select'];
                                            $_SESSION["locacao"][$key]['selectt'] = $cadastro['selectt'];
                                            $_SESSION["locacao"][$key]['datalocacao'] = $cadastro['datalocacao'];
                                            $_SESSION["locacao"][$key]['datadevolucao'] = $cadastro['datadevolucao'];
                                            $_SESSION["locacao"][$key]['valor'] = $cadastro['valor'];
                                        }
                                    }
                                }
                            }
                        foreach ($_SESSION['locacao'] as $key => $value) {
                            echo "<tr>
                                                 
                                                 <td>{$value['select']}</td>
                                                 <td>{$value['selectt']}</td>
                                                 <td>{$value['datalocacao']}</td>
                                                 <td>{$value['datadevolucao']}</td> 
                                                 <td>{$value['valor']}</td>                 
                                      <td>                 
                                        <form name='editar' action='' method='POST'>
                                            <input type='hidden' name='select' value='{$value['select']}' />
                                            <input type='hidden' name='selectt' value='{$value['selectt']}' />
                                            <input type='hidden' name='datalocacao' value='{$value['datalocacao']}' />
                                            <input type='hidden' name='datadevolucao' value='{$value["datadevolucao"]}'/>
                                            <input type='hidden' name='valor' value='{$value["valor"]}'/>
                                            <input type='submit' value='Editar' name='editar' class='btn btn-xs btn-warning'/>                                        
                                        </form>
                                    </td>
                                    <td>
                                        <form name='excluir' action='' method='POST'>
                                            <input type='hidden' name='select' id='select' value='{$value["select"]}'/>
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
