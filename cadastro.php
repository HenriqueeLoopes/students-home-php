<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '0');
session_start();

require_once 'classes/config.php';
require_once 'mail.php';

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarsenha = $_POST['confirmarsenha'];

    if ($senha != $confirmarsenha) {
        echo "<script language='javascript' type='text/javascript'>alert('As senhas nao conferem!');window.location.href='cadastro.php';</script>";
        die();
    }
    $query_select = "SELECT email FROM cadastro WHERE email = '$email'";
    $select = $con->query($query_select);
    $array = $select->fetch_assoc();
    $logarray = $array['email'];

    if ($email == "" || $email == null || $nome == "" || $nome == null || $senha == "" || $senha == null) {
        echo "<script language='javascript' type='text/javascript'>alert('Existem campos nao preenchidos!');window.location.href='cadastro.php';</script>";
    } else {
        if ($logarray == $email) {
            echo "<script language='javascript' type='text/javascript'>alert('Já existe um cadastro com este email!');window.location.href='cadastro.php';</script>";
            die();
        } else {
            $sql2 = "SELECT COUNT(id_cadastro) FROM cadastro;";
            $result = $con->query($sql2);
            $row = $result->fetch_assoc();
            $id_usuario = ($row['COUNT(id_cadastro)'] + 1);
            date_default_timezone_set('America/Sao_Paulo');
            $data_cadastro = date_create()->format('d-m-Y H:i:s');
            $sql = "INSERT INTO cadastro (nome, sobrenome, email, senha, data_cadastro) VALUES ('$nome', '$sobrenome', '$email', '$senha', '$data_cadastro');";
            if (!mysqli_query($con, $sql)) {
                echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao realizar o cadastro! ERRO: 105';</script>";
                header("Location: cadastro.php");
            }
            echo"<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso, verifique o seu email para confirmar a conta!');window.location.href='login.php';</script>";
            $con->close();

            $subject = "Confirmação de Cadastro - Student's Home";
            $message = "Prezado {$nome},<br />
Obrigado pelo seu cadastro em nosso site, <a href='https://www.studentshome.tk'> https://www.studentshome.tk</a>!<br/><br/>
Para confirmar seu cadastro e ativar sua conta em nosso site, podendo acessar areas exclusivas, por favor clique no link abaixo ou copie e cole na barra de
endereço do seu navegador.<br /> <br />
<a href='http://www.studentshome.tk/login.php?acao=ativar&id={$id_usuario}'>Ativar Conta</a>
<br/><br/>
Apos a ativacao de sua conta, voce podera ter acesso ao conteudo exclusivo
efetuado o login com os seguintes dados abaixo:<br > <br />
<strong>email:</strong> {$email}<br />
<strong>senha:</strong> {$senha}<br /> <br />
A equipe <strong>Student's Home</strong> agradece!<br /> <br />
Esta é uma mensagem automatica, por favor não responda!";

            if (EnviarEmail($nome, $email, $subject, $message)){
                echo"<script language='javascript' type='text/javascript'>alert('Enviamos um email para voce!! verifique a caixa de entrada do seu email ;)');window.location.href='login.php';</script>";
            }else{
                echo"<script language='javascript' type='text/javascript'>alert('Erro ao enviar o email!;)');window.location.href='cadastro.php';</script>";
            }
        }
        }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student's Home - Cadastro</title>
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
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/icone/android-icon-192x192.png">
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
  <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Bem Vindo ". $_SESSION['nome'] ."</button>
  <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
    <a class=\"dropdown-item\" href=\"minhaconta.php\">Minha Conta</a>
    <a class=\"dropdown-item\" href=\"login.php?acao=logout\">Sair</a>
  </div>
</div>";
                }else{
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
                    <h1>Faça parte da Student's Home Já !</h1>
                    <a>preencha os campos abaixo para completar o cadastro.</a><br><br>
                    <form action="cadastro.php" method="post" name="cadastrar">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João" required>
                        </div>
                        <div class="form-group">
                            <label for="sobrenome">Sobrenome:</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Ex: Mendes" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" required maxlength="36" placeholder="abc@abc.com">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" id="senha" name="senha" required minlength="6"  maxlength="18" placeholder="Min de 6 caracteres.">
                        </div>
                        <div class="form-group">
                            <label for="confirmarsenha">Senha:</label>
                            <input type="password" class="form-control" id="confirmarsenha" name="confirmarsenha" minlength="6" maxlength="18" required placeholder="Confirme sua senha">
                        </div>
                        <input type="hidden" name="cadastrar" id="cadastrar" value="cadastrar">
                        <div class="btn-group">
                        <button type="submit" class="btn btn-outline-success">Cadastrar</button>&nbsp;
                            <a href="login.php" class="btn btn-outline-danger">Já possui uma conta?</a>
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