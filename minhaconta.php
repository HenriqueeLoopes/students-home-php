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

if (!isset($_SESSION['email'])) {
    echo "<script language='javascript' type='text/javascript'>alert('Voce precisa estar logado para acessar esta pagina. ERRO 101');window.location.href='login.php';</script>"; // NÃO ESTA LOGADO
}
/*
                                                <div class="form-group row">
                                                    <label for="uf" class="col-4 col-form-label">Estado:*</label>
                                                    <div class="col-8">
                                                        <select id="uf" name="uf" required class="custom-select">
                                                            <?php
                                                            $sql = "SELECT * FROM estados;";
                                                            $result = $con->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while($row = $result->fetch_assoc()) {
                                                                    echo "<option value=\"". $row['sigla'] ."\">". $row['sigla']. " - ". $row['descricao'] ."</option>";
                                                                }
                                                            } else {
                                                                echo " ERRO AO CARREGAR OS ESTADOS. ";
                                                            }
                                                            $con->close();
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
 */
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student's Home - Minha Conta</title>
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
    <!--INPUT MASK-->
    <script src="js/jquery.mask.min.js"></script>
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
    <div id="minhaconta" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="container bootstrap snippet">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <h2>
                                            <?php
                                            if (isset($_SESSION['nome'])) {
                                                echo $_SESSION['nome'];
                                                if (isset($_SESSION['sobrenome'])) {
                                                    echo " " . $_SESSION['sobrenome'];
                                                }
                                            }
                                            ?>
                                        </h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <!--left col-->
                                        <div class="text-center">
                                            <?php
                                            $nome = $_SESSION['nome'];
                                            $email = $_SESSION['email'];
                                            $foto = "SELECT nome, sobrenome, email, foto FROM cadastro where email = '$email';";
                                            $foto2 = $con->query($foto);
                                            $foto3 = $foto2->fetch_assoc();
                                            ?>
                                            <img src="images/usuarios/<?php echo $foto3['foto']; ?>" class="img-thumbnail" alt="<?php echo $foto3['nome'] . " " . $foto3['sobrenome']; ?>">
                                            <form action="atualizar.php" method="post" enctype="multipart/form-data">
                                                <h6>Quer alterar sua foto ?</h6>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" required>
                                                    <label class="custom-file-label" for="fileToUpload">Escolha uma foto...</label>
                                                </div><br><br>
                                                <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                                                <input type="hidden" name="acao" id="acao" value="foto">
                                                <button type="submit" name="atualizar" id="atualizar" value="atualizar" class="btn btn-outline-success">Atualizar Foto</button>
                                            </form>
                                        </div>
                                        </hr><br>
                                        <ul class="list-group">
                                            <li class="list-group-item text-muted">Estatisticas <i class="fa fa-dashboard fa-1x"></i></li>
                                            <li class="list-group-item text-right"><span class="pull-left"><strong>Pontos</strong></span> 125</li>
                                            <li class="list-group-item text-right"><span class="pull-left"><strong>Avaliação</strong></span> 8,5</li>
                                        </ul>
                                    </div>
                                    <!--/col-3-->
                                    <div class="col-sm-9">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="home">
                                                <hr>
                                                <form action="atualizar.php" method="post">
                                                    <?php
                                                    $nome = $_SESSION['nome'];
                                                    $sql2 = "SELECT * FROM cadastro where email = '$email';";
                                                    $resultado = $con->query($sql2);
                                                    $linhas = $resultado->fetch_assoc();
                                                    ?>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="nome">Nome:*</label>
                                                            <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $linhas['nome']; ?>" required maxlength="45" placeholder="Ex: João">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sobrenome">Sobrenome:*</label>
                                                            <input type="text" class="form-control" name="sobrenome" id="sobrenome" value="<?php echo $linhas['sobrenome']; ?>" required maxlength="45" placeholder="Ex: Mendes">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="email">E-mail:*</label>
                                                            <input id="email" name="email" placeholder="abc@abc.com" class="form-control" value="<?php echo $linhas['email']; ?>" maxlength="45" required type="email">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="cpf">CPF:*</label>
                                                            <input id="cpf" name="cpf" placeholder="000.000.000-00" class="form-control " value="<?php echo $linhas['cpf']; ?>" required type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="rg">RG:*</label>
                                                            <input id="rg" name="rg" placeholder="00.000.000-0" class="form-control" value="<?php echo $linhas['rg']; ?>" required type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="telefone">Celular:*</label>
                                                            <input id="telefone" name="telefone" placeholder="(00) 0.0000-0000" class="form-control" value="<?php echo $linhas['telefone']; ?>" maxlength="16" required type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="datanasc">Data de Nascimento*</label>
                                                            <input id="datanasc" name="datanasc" placeholder="00/00/0000" class="form-control" value="<?php echo $linhas['data_nasc']; ?>" required type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sexo">Sexo:*</label>
                                                            <select id="sexo" name="sexo" required class="custom-select">
                                                                <?php
                                                                if ($linhas['sexo'] == "M") {
                                                                    echo "                                                          
                                                                  <option value=\"M\">Masculino &radic;</option>
                                                                  <option value=\"F\">Feminina</option>\";";
                                                                } else if ($linhas['sexo'] == "F") {
                                                                    echo " 
                                                                  <option value=\"F\">Feminina &radic;</option>                                                         
                                                                  <option value=\"M\">Masculino</option>\";";
                                                                } else {
                                                                    echo "                                                          
                                                            <option value=\"M\">Masculino</option>
                                                            <option value=\"F\">Feminina</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="cep">CEP:*</label>
                                                            <input onblur="pesquisacep(this.value);" id="cep" name="cep" placeholder="09195580" class="form-control" value="<?php echo $linhas['cep']; ?>" minlength="6" maxlength="6" required type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="uf">Estado:*</label>
                                                            <input id="uf" readonly name="uf" placeholder="Ex: São Paulo" class="form-control" value="<?php echo $linhas['estado']; ?>" minlength="6" maxlength="40" required type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="cidade">Cidade:*</label>
                                                            <input id="cidade" readonly name="cidade" placeholder="Ex: São Bernardo do Campo" class="form-control" value="<?php echo $linhas['cidade']; ?>" minlength="6" maxlength="40" required type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="bairro">Bairro:*</label>
                                                            <input id="bairro" readonly name="bairro" placeholder="Ex: Assunção" value="<?php echo $linhas['bairro']; ?>" minlength="5" maxlength="25" required class="form-control" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="rua">Rua:*</label>
                                                            <input id="rua" readonly name="rua" placeholder="Ex: Av Paulista" value="<?php echo $linhas['rua']; ?>" minlength="10" maxlength="45" required class="form-control" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="complemento">Complemento:</label>
                                                            <input id="complemento" name="complemento" placeholder="Ex: Bloco Alfa, Apto 162" value="<?php echo $linhas['complemento']; ?>" minlength="1" maxlength="35" class="form-control" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="endereco">Numero:*</label>
                                                            <input id="numero" name="numero" placeholder="Ex: 1050" value="<?php echo $linhas['numero']; ?>" minlength="1" maxlength="7" required class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="senha">Nova Senha*</label>
                                                            <input id="senha" name="senha" placeholder="********" class="form-control" minlength="6" maxlength="16" required type="password">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="confirmarsenha">Confirmar Nova Senha*</label>
                                                            <input id="confirmarsenha" name="confirmarsenha" placeholder="********" class="form-control" minlength="6" maxlength="16" required type="password">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="acao" id="acao" value="dados">
                                                    <div class="form-group row">
                                                        <div class="offset-4 col-8">
                                                            <button name="submit" type="submit" class="btn btn-primary">Atualizar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <nav class="navbar sticky-top navbar-light bg-light">
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
<script>
    jQuery(function($) {
        $("#telefone").mask("(99) 9.9999-9999");
        $("#cpf").mask("999.999.999-99");
        $("#rg").mask("99.999.999-9");
        $("#datanasc").mask("99/99/9999");
        $("#cep").mask("99999-999");
    });
</script>

</html>