<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '0');
session_start();

require 'classes/config.php';

if (isset($_SESSION['nome'])){

}else{
    echo"<script language='javascript' type='text/javascript'>alert('Voce precisa estar logado para acessar esta pagina. ERRO 101');window.location.href='login.php';</script>"; // NÃO ESTA LOGADO
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            background: url(images/background.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student's Home - Minha Conta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
</head>
<body class="uk-height-1-1">
<nav class="uk-navbar-container uk-margin" uk-navbar>
    <div class="uk-navbar-center">
        <a class="uk-navbar-item uk-logo" href="index.php">Student's Home</a>
        <ul class="uk-navbar-nav">
            <li>
                <a href="index.php">Inicio</a>
            </li>
        </ul>
        <ul class="uk-navbar-nav">
            <li>
                <a href="hospedagem.php">Hospedagem</a>
            </li>
        </ul>
        <ul class="uk-navbar-nav">
            <li>
                <a href="quemsomos.php">Quem Somos</a>
            </li>
        </ul>
        <ul class="uk-navbar-nav">
            <li>
                <a href="faleconosco.php">Fale Conosco</a>
            </li>
        </ul>
        <ul class="uk-navbar-nav">
            <li>
                <a href="faq.php">FAQ</a>
            </li>
        </ul>
        <ul class="uk-navbar-nav">
            <li>
                <a href="parceiros.php">Parceiros</a>
            </li>
        </ul>
        <div class="uk-navbar-item">
            <form action="login.php" method="post">
                <?php
                if (isset($_SESSION['nome'])) {
                    echo
                        "<div class=\"dropdown\">
  <button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Bem Vindo ". $_SESSION['nome'] ."</button>
  <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
    <a class=\"dropdown-item\" href=\"minhaconta.php\">Minha Conta</a>
    <a class=\"dropdown-item\" href=\"logout.php\">Sair</a>
  </div>
</div>";
                }else{
                    echo "<button class=\"uk-button uk-button-default\">Login/Cadastrar</button>";
                }
                ?>
            </form>
        </div>
    </div>
</nav>

<div id="minhaconta" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="container bootstrap snippet">
                            <div class="row">
                                <div class="col-sm-10"><h1><?php  echo $_SESSION['nome']; ?></h1></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"><!--left col-->


                                    <div class="text-center">
                                        <?php
                                        $nome = $_SESSION['nome'];
                                        $foto = "SELECT email FROM cadastro where nome = '$nome';";
                                        $foto2 = $con->query($foto);
                                        $foto3 = $foto2->fetch_assoc();
                                        ?>
                                        <img src="images/usuarios/<?php echo $foto3['email'];?>.jpg" class="avatar img-circle img-thumbnail" alt="<?php echo $_SESSION['nome'];?>">
                                        <form action="atualizar.php" method="post" enctype="multipart/form-data">
                                            <h6>Quer alterar sua foto ?</h6>
                                            <input type="file" class="text-center center-block file-upload"><br><br>
                                            <input type="hidden" name="acao" id="acao" value="foto">
                                            <button type="submit" name="atualizar" id="atualizar" value="atualizar" class="btn-outline-success">Atualizar Foto</button>
                                        </form>
                                    </div></hr><br>


                                    <ul class="list-group">
                                        <li class="list-group-item text-muted">Estatatisticas <i class="fa fa-dashboard fa-1x"></i></li>
                                        <li class="list-group-item text-right"><span class="pull-left"><strong>Pontos</strong></span> 125</li>
                                        <li class="list-group-item text-right"><span class="pull-left"><strong>Avaliação</strong></span> 8,5</li>
                                    </ul>

                                </div><!--/col-3-->
                                <div class="col-sm-9">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home">
                                            <hr>
                                            <form action="atualizar.php" method="post">
                                                <?php
                                                $nome = $_SESSION['nome'];
                                                $sql2 = "SELECT * FROM cadastro where nome = '$nome';";
                                                $resultado = $con->query($sql2);
                                                $linhas = $resultado->fetch_assoc();
                                                ?>
                                                <div class="form-group row">
                                                    <label for="nome" class="col-4 col-form-label">Nome:*</label>
                                                    <div class="col-8">
                                                        <input id="nome" name="nome" placeholder="Ex: João" class="form-control here" value="<?php echo $linhas['nome']; ?>" required type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="sobrenome" class="col-4 col-form-label">Sobrenome:*</label>
                                                    <div class="col-8">
                                                        <input id="sobrenome" name="sobrenome" placeholder="Ex: Mendes" class="form-control here" value="<?php echo $linhas['sobrenome']; ?>" required type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-4 col-form-label">E-mail:*</label>
                                                    <div class="col-8">
                                                        <input id="email" name="email" placeholder="abc@abc.com" class="form-control here" value="<?php echo $linhas['email']; ?>" required type="email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cpf" class="col-4 col-form-label">CPF:*</label>
                                                    <div class="col-8">
                                                        <input id="cpf" name="cpf" placeholder="000.000.000-00" class="form-control here" value="<?php echo $linhas['cpf']; ?>" required type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="rg" class="col-4 col-form-label">RG:*</label>
                                                    <div class="col-8">
                                                        <input id="rg" name="rg" placeholder="00.000.000-0" class="form-control here" value="<?php echo $linhas['rg']; ?>" required type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="telefone" class="col-4 col-form-label">Telefone ou Celular:*</label>
                                                    <div class="col-8">
                                                        <input id="telefone" name="telefone" placeholder="(00) 0.0000-0000" class="form-control here" value="<?php echo $linhas['telefone']; ?>" required type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="datanasc" class="col-4 col-form-label">Email*</label>
                                                    <div class="col-8">
                                                        <input id="datanasc" name="datanasc" placeholder="00/00/0000" class="form-control here" value="<?php echo $linhas['data_nasc']; ?>" required type="date">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="sexo" class="col-4 col-form-label">Sexo:*</label>
                                                    <div class="col-8">
                                                        <select id="sexo" name="sexo" required class="custom-select">
                                                            <?php
                                                            if ($linhas['sexo'] == "M"){
                                                                echo "                                                          
                                                                  <option value=\"M\">Masculino &radic;</option>
                                                                  <option value=\"F\">Feminina</option>\";";
                                                            }else if ($linhas['sexo'] == "F"){
                                                                echo " 
                                                                  <option value=\"F\">Feminina &radic;</option>                                                         
                                                                  <option value=\"M\">Masculino</option>\";";
                                                            }else {
                                                                echo "                                                          
                                                            <option value=\"M\">Masculino</option>
                                                            <option value=\"F\">Feminina</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="estado" class="col-4 col-form-label">Estado:*</label>
                                                    <div class="col-8">
                                                        <select id="estado" name="estado" required class="custom-select">
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
                                                <div class="form-group row">
                                                    <label for="cidade" class="col-4 col-form-label">Cidade:*</label>
                                                    <div class="col-8">
                                                        <input id="cidade" name="cidade" placeholder="Ex: São Paulo" class="form-control here" value="<?php echo $linhas['cidade']; ?>" required type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="endereco" class="col-4 col-form-label">Endereço:*</label>
                                                    <div class="col-8">
                                                        <input id="endereco" name="endereco" placeholder="Ex: Avenida Paulista, 1300, São Paulo, Brasil" value="<?php echo $linhas['endereco']; ?>" required class="form-control here" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="senha" class="col-4 col-form-label">Nova Senha*</label>
                                                    <div class="col-8">
                                                        <input id="senha" name="senha" placeholder="********" class="form-control here" required type="password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="confirmarsenha" class="col-4 col-form-label">Confirmar Nova Senha*</label>
                                                    <div class="col-8">
                                                        <input id="confirmarsenha" name="confirmarsenha" placeholder="********" class="form-control here" required type="password">
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
                                        </div><!--/tab-pane-->
                                    </div><!--/tab-pane-->
                                </div><!--/tab-content-->
                            </div><!--/col-9-->
                        </div>
            </div>
        </div>
    </div>
    </div>
</div>



    <nav class="navbar fixed-bottom navbar-light bg-light">
        <span class="float-left"><?php echo $Endereco; ?></span>
        <div class="btn-group">
            <a href="<?php echo $LinkFacebook; ?>" class="navbar-brand fa fa-facebook align-items-center"></a>
            <a href="<?php echo $LinkTwitter; ?>" class="navbar-brand fa fa-twitter align-items-center"></a>
            <a href="<?php echo $LinkInstagram; ?>" class="navbar-brand fa fa-instagram align-items-center"></a>
        </div>
        <span class="float-right"><?php echo $Copyright; ?></span>
    </nav>

</body>
</html>