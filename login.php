<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '0');
session_start();

require 'classes/config.php';
if (isset($_SESSION['nome'])) {
    header('Location: minhaconta.php');
}
if (isset($_GET['acao']) && $_GET['acao'] == "logout") {
    session_destroy();
    header('Location: index.php');
}
if (isset($_GET['acao']) && $_GET['acao'] == 'ativar' && isset($_GET['id'])) {
    $usuario_id = $_GET['id'];
    $linhas = $con->query("SELECT * FROM cadastro WHERE id_cadastro = '$usuario_id';")->fetch_assoc();

    if ($linhas['ativado'] == '1') {
        echo "<script language='javascript' type='text/javascript'>alert('Este cadastro ja esta ativado!');window.location.href='login.php';</script>";
        die();
    }
    $aaa = $con->query("UPDATE cadastro SET ativado = '1' WHERE id_cadastro = '$usuario_id';");
    $sql2 = "SELECT * FROM cadastro WHERE id_cadastro = '$usuario_id' AND ativado = '1';";

    if (!$con->query($sql2)) {
        echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao ativar a sua conta!, utilize o fale conosco. ERRO: 102');window.location.href='faleconosco.php';</script>";
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Seu cadastro foi ativado com sucesso!');window.location.href='login.php';</script>";
    }
    $con->close();
}

if (isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT nome, sobrenome, email, senha, ativado FROM cadastro WHERE email = '$email' AND senha = '$senha';";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows <= 0) {
        echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos.');window.location.href='login.php';</script>";
        die();
    } else if ($row['senha'] != $senha) {
        echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos.');window.location.href='login.php';</script>";
        die();
    } else {
        if ($row['ativado'] == '0') {
            echo "<script language='javascript' type='text/javascript'>alert('Voce ainda nao ativou a sua conta, visite o seu email e ative-a.');window.location.href='login.php';</script>";
            die();
        }
        date_default_timezone_set('America/Sao_Paulo');
        $ultimo_login = date_create()->format('d-m-Y H:i:s');
        $updateultimologin = "UPDATE cadastro SET ultimo_login = '$ultimo_login' WHERE email = '$email'";
        $executar = $con->query($updateultimologin);
        //setcookie("nome", $row['nome']);
        $_SESSION['nome'] = $row['nome'];
        if ($row['sobrenome'] != null && $row['sobrenome'] != "") {
            $_SESSION['sobrenome'] = $row['sobrenome'];
        }
        $_SESSION['email'] = $row['email'];
        header("Location: minhaconta.php");
    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student's Home - Login</title>
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
                        <h1><?php echo $TituloLogin; ?></h1>
                        <a><?php echo $TextoLogin; ?></a><br>
                        <form action="login.php" method="post" name="logar">
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" minlength="10" maxlength="36" required placeholder="abc@abc.com">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" minlength="6" maxlength="18" required placeholder="************">
                            </div>
                            <div class="btn-group">
                                <button type="submit" name="entrar" id="entrar" class="btn btn-outline-success">Entrar</button>&nbsp;
                                <a href="cadastro.php" class="btn btn-outline-warning">Cadastrar-se</a>
                                <a href="esqueceusenha.php" class="btn btn-outline-danger">Esqueceu a senha ?</a>
                            </div>
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