<?php

error_reporting(E_ALL ^ E_DEPRECATED);

ini_set('display_errors', '0');

session_start();



require 'classes/config.php';



if (isset($_POST['enviar']) && $_POST['enviar'] == "enviar") {

    $Nome = $_POST['nome'];

    $Email = $_POST['email'];

    $Assunto = $_POST['assunto'];

    $Mensagem = $_POST['mensagem'];

    if (strlen($Nome) < 4 || strlen($Email) < 10 || strlen($Assunto) < 4 || strlen($Mensagem) < 10) {

        echo "<script language='javascript' type='text/javascript'>alert('ERRO CAMPOS NULOS OU COM POUCO TEXTO');window.location.href='faleconosco.php';</script>";

        echo strlen($Nome) . " - " . strlen($Email) . " - " . strlen($Assunto) . " - " . strlen($Mensagem);

        die();
    }

    date_default_timezone_set('America/Sao_Paulo');

    $datetime = date_create()->format('d-m-Y H:i:s');

    $sql = "INSERT INTO atendimento(Nome, Email, Assunto, Mensagem, datetime) VALUES ('$Nome', '$Email', '$Assunto', '$Mensagem', '$datetime');";



    if (!mysqli_query($con, $sql)) {

        echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao enviar o seu contato, tente novamente.');window.location.href='faleconosco.php';</script>";

        die();
    } else {

        echo "<script language='javascript' type='text/javascript'>alert('Contato enviado com sucesso!');window.location.href='index.php';</script>";
    }

    mysqli_close($con);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student's Home - Fale Conosco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Henrique Lopes">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/bootstrap-grid.css" />
    <link rel="stylesheet" href="css/bootstrap-reboot.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    <br><br><br>
    <div class="container align-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                    <div class="card-body">
                        <h1><?php echo $TituloFaleConosco; ?></h1>
                        <span><?php echo $TextoFaleConosco; ?></span><br><br>
                        <form action="faleconosco.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <?php
                                if (isset($_SESSION['nome'])) {
                                    echo "<input type=\"text\" class=\"form-control\" name=\"nome\" id=\"nome\" minlength=\"4\" maxlength=\"45\" value='" . $_SESSION['nome'] . "' readonly required>";
                                } else {
                                    echo "<input type=\"text\" class=\"form-control\" name=\"nome\" id=\"nome\" minlength=\"4\" maxlength=\"45\" required>";
                                }
                                ?>
                            </div>
                            <?php
                            if (isset($_SESSION['nome'])) {
                                if (isset($_SESSION['email'])) {
                                    $email = $_SESSION['email'];
                                }
                            }
                            ?>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <?php
                                if (isset($email)) {
                                    echo "<input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\" minlength=\"10\" maxlength=\"30\" value='" . $email . "' readonly required>";
                                } else {
                                    echo "<input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\" minlength=\"10\" maxlength=\"30\" required>";
                                }
                                ?>
                                <div class="form-group">
                                    <label for="assunto">Assunto:</label>
                                    <input type="text" class="form-control" name="assunto" id="assunto" minlength="4" maxlength="60" required>
                                </div>
                                <div class="form-group">
                                    <label for="mensagem">Mensagem:</label>
                                    <textarea class="form-control" rows="5" name="mensagem" id="mensagem" minlength="10" maxlength="2000" required></textarea>
                                </div>
                                <input type="hidden" id="enviar" name="enviar" value="enviar">
                                <button type="submit" class="btn btn-outline-success">Enviar</button>
                        </form>
                    </div>
                </div>
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
</body>

</html>