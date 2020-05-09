<?php
//REMOVE POSSIVEIS ALERTAS
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '0');
//NAO SALVAR CACHE
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

//INICIA O SERVICO DE SESSOES
session_start();

//CARREGA UMA CONFIG EXTERNA
require 'classes/config.php';

//RECUPERA OS DADOS DE FILTRO VIA GET
if (isset($_GET['avaliacao'])) {
    $_SESSION['avaliacao'] = $_GET['avaliacao'];
}
if (isset($_GET['localizacao'])) {
    $_SESSION['localizacao'] = $_GET['localizacao'];
}
if (isset($_GET['cidade'])) {
    $_SESSION['cidade'] = $_GET['cidade'];
}
if (isset($_GET['tipo'])) {
    $_SESSION['tipo'] = $_GET['tipo'];
}
if (isset($_GET['ordem'])) {
    $_SESSION['ordem'] = $_GET['ordem'];
}
if (isset($_GET['categoria'])) {
    $_SESSION['categoria'] = $_GET['categoria'];
}

//REMOVE OS FILTROS
if (isset($_GET['destruir'])) {
    session_destroy();
    header('Location: hospedagem.php');
}
if (isset($_GET['removerfiltros'])) {
    unset($_SESSION['avaliacao']);
    unset($_SESSION['localizacao']);
    unset($_SESSION['cidade']);
    unset($_SESSION['tipo']);
    unset($_SESSION['categoria']);
    unset($_SESSION['ordem']);
    header('Location: hospedagem.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student's Home - Hospedagem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Henrique Lopes">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.css" />
    <link rel="stylesheet" href="css/bootstrap-reboot.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/background.css" />
    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="/images/icone/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/icone/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icone/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icone/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icone/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icone/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icone/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icone/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/icone/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/icone/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icone/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/icone/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icone/favicon-16x16.png">
    <link rel="manifest" href="/images/icone/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/icone/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- FAVICON -->
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" width="110" height="110" class="d-inline-block align-top" alt="Student's Home">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-light" href="index.php">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link btn btn-light" href="hospedagem.php">Hospedagem<span class="sr-only">(Atual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light" href="quemsomos.php">Quem Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light" href="faleconosco.php">Fale Conosco</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light" href="faq.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light" href="parceiros.php">Parceiros</a>
                </li>
            </ul>
            <span class="navbar-text">
                <form action="login.php" method="post">
                    <?php
                    if (isset($_SESSION['nome'])) {
                        echo
                            "<div class=\"dropdown\">
  <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Bem Vindo " . $_SESSION['nome'] . "</button>
  <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
    <a class=\"dropdown-item\" href=\"minhaconta.php\">Minha Conta</a>
    <a class=\"dropdown-item\" href=\"login.php?acao=logout\">Sair</a>
  </div>
</div>";
                    } else {
                        echo "<button class=\"btn btn-light\">Login/Cadastrar</button>";
                    }
                    ?>
                </form>
            </span>
        </div>
    </nav>
    <div class="container align-content-center text-center">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card-body">
                    <img src="images/hospedagens.png" class="img-thumbnail">
                </div>
            </div>
        </div>
    </div>
    <div class="album py-5 bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="mx-auto order-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tipos de Hospedagens</a>
                            <div class="dropdown-menu scrollable-menu" aria-labelledby="navbarDropdown">
                                <?php
                                //CARREGA O FILTRO DE TIPOS
                                $sql = "SELECT * FROM tipos;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<a class=\"dropdown-item\" href=\"hospedagem.php?tipo=" . $row['id_tipo'] . "\">" . $row['tipo_hospedagem'] . "</a><div class=\"dropdown-divider\"></div>";
                                    }
                                } else {
                                    echo " ERRO AO CARREGAR OS TIPOS. ";
                                }
                                ?>
                            </div>
                        </li>
                        <?php
                        //CARREGA O FILTRO DE CATEGORIAS
                        if (isset($_SESSION['tipo'])) {
                            if ($_SESSION['tipo'] == 1) {
                                echo "<li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Categorias</a>
                    <div class=\"dropdown-menu scrollable-menu\" aria-labelledby=\"navbarDropdown\">";
                                $sql = "SELECT * FROM categorias;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<a class=\"dropdown-item\" href=\"hospedagem.php?categoria=" . $row['id_categoria'] . "\">" . $row['nome_categoria'] . "</a><div class=\"dropdown-divider\"></div>";
                                    }
                                } else {
                                    echo " ERRO AO CARREGAR AS CATEGORIAS. ";
                                }
                                echo "</div></li>";
                            }
                        }
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Estados</a>
                            <div class="dropdown-menu scrollable-menu" aria-labelledby="navbarDropdown">
                                <?php
                                //CARREGA OS ESTADOS
                                $sql = "SELECT * FROM estado;";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<a class=\"dropdown-item\" href=\"hospedagem.php?localizacao=" . $row['id'] . "\">" . utf8_encode($row['nome']) . "</a><div class=\"dropdown-divider\"></div>";
                                    }
                                } else {
                                    echo " ERRO AO CARREGAR OS ESTADOS. ";
                                }
                                ?>
                            </div>
                        </li>
                        <?php
                        //CARREGA AS CIDADES
                        if (isset($_SESSION['localizacao'])) {
                            echo "<li class=\"nav-item dropdown\"><a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Cidades</a>
                    <div class=\"dropdown-menu scrollable-menu\" aria-labelledby=\"navbarDropdown\">";
                            $estado = $_SESSION['localizacao'];
                            $sql = "SELECT * FROM cidade WHERE estado = $estado;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<a class=\"dropdown-item\" href=\"hospedagem.php?cidade=" . $row['id'] . "\">" . utf8_encode($row['nome']) . "</a><div class=\"dropdown-divider\"></div>";
                                }
                            } else {
                                echo " ERRO AO CARREGAR AS CIDADES. ";
                            }
                            echo "</div></li>";
                        }
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Avaliação &#10025;</a>
                            <div class="dropdown-menu scrollable-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?avaliacao=5">5 &#10025;&#10025;&#10025;&#10025;&#10025;</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?avaliacao=4">4 &#10025;&#10025;&#10025;&#10025;</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?avaliacao=3">3 &#10025;&#10025;&#10025;</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?avaliacao=2">2 &#10025;&#10025;</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?avaliacao=1">0/1 &#10025;</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classificar</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?ordem=DESC">Maior Preço</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?ordem=ASC">Menor Preço</a>
                            </div>
                        </li>
                        <?php
                        if (isset($_SESSION['avaliacao']) || isset($_SESSION['localizacao']) || isset($_SESSION['ordem']) || isset($_SESSION['tipo']) || isset($_SESSION['valor'])) {
                            echo "<li class=\"nav-item dropdown\">
                    <form action=\"hospedagem.php?removerfiltros\" method=\"post\">
                        <button class=\"btn btn-light\" type=\"submit\">Remover Filtros</button>
                    </form>
                </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <div class="col-xs-6">
                                <p>
                                    <label for="amount">Faixa de preço:</label>
                                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                </p>
                                <div id="slider-range"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <?php

                //REALIZA AS CONSULTAS NOS BANCOS DE DADOS BASEADO NOS FILTROS

                if (isset($_SESSION['ordem']) && isset($_SESSION['avaliacao']) && isset($_SESSION['localizacao']) && isset($_SESSION['cidade'])) {
                    $sql = "SELECT * FROM hospedagens WHERE avaliacao = '{$_SESSION['avaliacao']}' AND id_estado = '{$_SESSION['localizacao']}' AND id_cidade = '{$_SESSION['cidade']}' ORDER BY preco '{$_SESSION['ordem']}';";
                } else if (isset($_SESSION['ordem']) && isset($_SESSION['avaliacao']) && isset($_SESSION['localizacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE avaliacao = '{$_SESSION['avaliacao']}' AND id_estado = '{$_SESSION['localizacao']}' ORDER BY preco '{$_SESSION['ordem']}';";
                } else if (isset($_SESSION['ordem']) && isset($_SESSION['avaliacao']) && isset($_SESSION['localizacao']) && isset($_SESSION['tipo'])) {
                    $sql = "SELECT * FROM hospedagens WHERE avaliacao = '{$_SESSION['avaliacao']}' AND id_estado = '{$_SESSION['localizacao']}' AND id_tipo = '{$_SESSION['tipo']}' ORDER BY preco '{$_SESSION['ordem']}';";
                } else if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1 && isset($_SESSION['categoria']) && isset($_SESSION['localizacao']) && isset($_SESSION['cidade'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_tipo = '{$_SESSION['tipo']}' AND id_categoria = '{$_SESSION['categoria']}' AND id_estado = '{$_SESSION['localizacao']}' AND id_cidade = '{$_SESSION['cidade']}';";
                } else if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1 && isset($_SESSION['categoria']) && isset($_SESSION['localizacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_tipo = '{$_SESSION['tipo']}' AND id_categoria = '{$_SESSION['categoria']}' AND id_estado = '{$_SESSION['localizacao']}';";
                } else if (isset($_SESSION['tipo']) && isset($_SESSION['ordem']) && isset($_SESSION['avaliacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_tipo = '{$_SESSION['tipo']}' AND avaliacao = '{$_SESSION['avaliacao']}' ORDER BY preco '{$_SESSION['ordem']}';";
                } else if (isset($_SESSION['tipo']) && isset($_SESSION['ordem'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_tipo = '{$_SESSION['tipo']}' ORDER BY preco '{$_SESSION['ordem']}';";
                } else if (isset($_SESSION['tipo']) && isset($_SESSION['avaliacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_tipo = '{$_SESSION['tipo']}' AND avaliacao = '{$_SESSION['avaliacao']}';";
                } else if (isset($_SESSION['tipo']) && isset($_SESSION['localizacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_estado = '{$_SESSION['localizacao']}' AND id_tipo = '{$_SESSION['tipo']}';";
                } else if (isset($_SESSION['tipo']) && isset($_SESSION['localizacao']) && isset($_SESSION['avaliacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_estado = '{$_SESSION['localizacao']}' AND id_tipo = '{$_SESSION['tipo']}' AND avaliacao = '{$_SESSION['avaliacao']}';";
                } else if (isset($_SESSION['ordem']) && isset($_SESSION['localizacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_estado = '{$_SESSION['localizacao']}' ORDER BY preco '{$_SESSION['ordem']}';";
                } else if (isset($_SESSION['tipo']) && isset($_SESSION['categoria']) && $_SESSION['tipo'] == 1) {
                    $sql = "SELECT * FROM hospedagens WHERE id_tipo = '{$_SESSION['tipo']}' AND id_categoria = '{$_SESSION['categoria']}';";
                } else if (isset($_SESSION['localizacao']) && isset($_SESSION['avaliacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_estado = '{$_SESSION['localizacao']}' AND avaliacao = '{$_SESSION['avaliacao']}';";
                } else if (isset($_SESSION['localizacao']) && isset($_SESSION['cidade'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_estado = '{$_SESSION['localizacao']}' AND id_cidade = '{$_SESSION['cidade']}';";
                } else if (isset($_SESSION['ordem'])) {
                    $sql = "SELECT * FROM hospedagens ORDER BY preco '{$_SESSION['ordem']}';";
                } else if (isset($_SESSION['avaliacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE avaliacao = '{$_SESSION['avaliacao']}' ORDER BY avaliacao ASC;";
                } else if (isset($_SESSION['localizacao'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_estado = '{$_SESSION['localizacao']}'";
                } else if (isset($_SESSION['tipo'])) {
                    $sql = "SELECT * FROM hospedagens WHERE id_tipo = '{$_SESSION['tipo']}';";
                } else {
                    $sql = "SELECT * FROM hospedagens;";
                }
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class=\"col-md-3 boxQuadro\">";
                        echo "<div class=\"card mb-3 box-shadow\" data-preco='{$row['preco']}'>";
                        echo "<img class=\"card-img-top\" height=\"300\" src=\"images/hospedagens/" . $row['foto_hospedagem'] . "\" alt=\"" . $row['nome_hospedagem'] . "\">";
                        echo "<div class=\"card-body\">";
                        echo "<h4><p class=\"card-text\">" . utf8_encode($row['nome_hospedagem']) . "</p></h4>";
                        echo "<p class=\"card-text\">" . utf8_encode($row['descricao_hospedagem']) . "</p>";
                        echo "<div class=\"d-flex justify-content-between align-items-center\">";
                        echo "<div class=\"btn-group\">";
                        echo "<span class=\"btn btn-sm btn-outline-secondary\">R$" . $row['preco'] . "</span>";
                        echo "<a href=\"detalhes.php?id=" . $row['id_hospedagem'] . "\" class=\"btn btn-sm btn-outline-secondary\">saiba mais</a>";
                        echo "<span class=\"btn btn-sm btn-outline-secondary\">" . $row['avaliacao'] . " &#10025;</span>";
                        echo " </div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div><br>";
                    }
                } else {
                    echo "    <div class=\"alert alert-danger\" role=\"alert\">

        Ops, nao encontramos nenhum item com estas especificacoes, <a href=\"hospedagem.php?removerfiltros\">clique aqui para remover os filtros.</a>

    </div>";
                }
                $con->close();
                ?>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <nav class="navbar fixed-bottom navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" width="90" height="90" class="d-inline-block align-top" alt="Student's Home">
        </a>
        <div class="btn-group">
            <a href="<?php echo $LinkFacebook; ?>" class="navbar-brand fa fa-facebook align-items-center"></a>
            <a href="<?php echo $LinkTwitter; ?>" class="navbar-brand fa fa-twitter align-items-center"></a>
            <a href="<?php echo $LinkInstagram; ?>" class="navbar-brand fa fa-instagram align-items-center"></a>
        </div>
        <span class="float-right"><?php echo $Copyright; ?></span>
    </nav>
    <script>
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 3500,
                values: [100, 2000],
                slide: function(event, ui) {
                    $("#amount").val("R$" + ui.values[0] + " - R$" + ui.values[1]);
                },
                change: function(event, ui) {
                    var minimo = ui.values[0];
                    var maximo = ui.values[1];

                    $('.boxQuadro').hide();

                    $('.boxQuadro').each(function() {
                        valor = $(this).find('.card').data('preco');
                        if (valor >= minimo && valor <= maximo) {
                            $(this).fadeIn();
                        }
                    });
                }
            });
            $("#amount").val("R$" + $("#slider-range").slider("values", 0) +
                " - R$" + $("#slider-range").slider("values", 1));
        });
    </script>
</body>

</html>