
<?php
session_start();


if (!isset($_SESSION['s_login'])) {
    header('location: login.php');
    die;
}

if (isset($_SESSION["cliente"])) {
    goto in_serir;
    die;
}
$_SESSION['cliente'] = array(
    array(
        "codigo" => "1",
        "nomec" => "Hudson",
        "cpf" => "45343530656"
    ),
    array(
        "codigo" => "2",
        "nomec" => "fulano",
        "cpf" => "31868625745"
    ),
    array(
        "codigo" => "3",
        "nomec" => "ciclano",
        "cpf" => "08837518951"
    ),
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
                        <li><a>Clientes</a></li>
                        <li><a href="filme.php">Filmes</a></li> 
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
            <h1>Inserir Cliente</h1>
            <h4>Aqui você pode inserir um Cliente a Locadora X - CRUD.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                ?>
                <form name="dadosCliente" action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Nome do Cliente</th>
                                <th>CPF</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>  

                        <td><input type="text" name="nomec"  value=""  /></td>
                        <td><input type="text" name="cpf" maxlength="14" value="" /></td>

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
            <h1>Editar Cliente</h1>
            <h4>Aqui você pode editar um Cliente a Locadora X - CRUD.</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                ?>
                <form name="dadosCliente" action="" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome do Cliente</th>
                                <th>CPF</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>  

                        <input type="hidden" name="codigo"  value="<?php
                        if (isset($_POST["editar"])) {
                            echo $_POST["codigo"];
                        }
                        ?>"  />

                        <td><input type="text" name="nomec"  value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["nomec"];
                            }
                            ?>"  /></td>
                        <td><input type="text" name="cpf" maxlength="14" value="<?php
                            if (isset($_POST["editar"])) {
                                echo $_POST["cpf"];
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

            <h1>Clientes</h1>


        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome do Cliente</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("conexao.php");
                        $controle = TRUE;
                        $x = 0;
                        $cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if (!isset($_SESSION["cliente"])) {
                            header('location: login.php');
                            die;
                        }
                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "editar") {
                                if (!empty(Check::VerificarDocumento('F', $cadastro["cpf"]))):
                                    foreach ($_SESSION["cliente"] as $key => $value) {
                                        while ($cadastro["cpf"] === $value["cpf"]) {
                                            $controle = FALSE; goto sair; break;
                                        }
                                        
                                        while (($cadastro["cpf"] != $value["cpf"]) === TRUE) {
                                            if (intval($cadastro["codigo"]) == $value["codigo"]):
                                                $_SESSION["cliente"][$key]["nomec"] = $cadastro["nomec"];
                                                $_SESSION["cliente"][$key]["cpf"] = $cadastro["cpf"];
                                            endif;

                                            break;
                                        }
                                    }
                                    echo '<div class = "alert alert-success" role = "alert"><strong>SUCESSO</strong> Alteração efetuada.</div>';
                                    sair:
                                        echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> CPF IGUAL.</div>';
                                else:
                                    echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> CPF INVÁLIDO.</div>';
                                endif;
                            }
                        }


                        /*
                          // VALIDAÇÃO + ALTERAÇÃO
                          foreach ($_SESSION["cliente"] as $key => $valuee) {
                          $erro = array("key" => $key, "codigo" => $valuee["codigo"], "cod_erro" => '');
                          if (($_POST["cpf"] == $valuee["cpf"])):
                          $erro["cod_erro"] .= 1 . ", ";
                          $controle = TRUE;
                          else:
                          $controle = FALSE;
                          $erro["cod_erro"] .= 2 . ", ";
                          endif;

                          if (intval($cadastro["codigo"]) == ($valor = (string) $valuee["codigo"])):
                          $erro["cod_erro"] .= 3 . ", ";
                          $controle = TRUE;
                          else:
                          $controle = FALSE;
                          $erro["cod_erro"] .= 4 . ", ";
                          endif;
                          echo "<p>KEY {$erro["key"]} | CODIGO: {$erro["codigo"]} | CODIGO ERRO: {$erro["cod_erro"]} | CONTROLE : " . var_dump($controle) . "</p>";
                          echo '<hr>';
                          }

                          var_dump($controle);
                          if ($controle == TRUE):
                          echo $erro["cod_erro"] = 5;
                          $_SESSION["cliente"][$key]["nomec"] = $cadastro["nomec"];
                          $_SESSION["cliente"][$key]["cpf"] = $cadastro["cpf"];
                          echo '<div class = "alert alert-success" role = "alert"><strong>SUCESSO</strong> Cadastro efetuado.</div>';
                          endif;

                          else:
                          echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> CPF INVÁLIDO.</div>';
                          endif;
                          }
                          } */


                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "inserir") {
                                if (!empty(Check::VerificarDocumento('F', $cadastro["cpf"]))) :
                                    $registro = array("codigo" => count($_SESSION["cliente"]) + 1, "nomec" => $_POST["nomec"], "cpf" => $_POST["cpf"]);
                                    foreach ($_SESSION["cliente"] as $key => $value) :
                                    endforeach;
                                    if ($_POST["cpf"] != $value["cpf"]) :
                                        array_push($_SESSION["cliente"], $registro);
                                        echo '<div class = "alert alert-success" role = "alert"><strong>SUCESSO</strong> Cadastro efetuado.</div>';
                                    else :
                                        echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> CADASTRO VAZIO, CPF INVÁLIDO OU REPETIDO.</div>';
                                    endif;
                                endif;
                            }
                        }




                        if (isset($_POST["acao"])) {
                            if ($_POST["acao"] === "excluir") {
                                $array = [];
                                foreach ($_SESSION["cliente"] as $key => $value) {

                                    if (intval($cadastro["codigo"]) != $value["codigo"]) :
                                        array_push($array, $value);
                                    endif;
                                }
                                $_SESSION["cliente"] = $array;
                                echo '<div class = "alert alert-warning" role = "alert"><strong>ATENÇÃO</strong> Cadastro Excluído.</div>';
                            }
                        }


                        foreach ($_SESSION["cliente"] as $key => $value) {
                            echo "<tr>
                                    <td>{$value['codigo']}</td> 
                                    <td>{$value['nomec']}</td>
                                    <td>{$value['cpf']}</td>
                                    <td>                 
                                        <form name='editar' action='' method='POST'>
                                            <input type='hidden' name='codigo' value='{$value['codigo']}' />
                                            <input type='hidden' name='nomec' value='{$value['nomec']}' />
                                            <input type='hidden' name='cpf' value='{$value['cpf']}' />
                                            <input type='submit' value='Editar' name='editar' class='btn btn-xs btn-warning'/>                                        
                                        </form>
                                    </td><td>
                                        <form name='excluir' action='' method='POST'>
                                            <input type='hidden' name='codigo' value='{$value['codigo']}' />
                                            <input type='hidden' name='nomec' value='{$value['nomec']}' />
                                            <input type='hidden' name='cpf' value='{$value['cpf']}' />
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
