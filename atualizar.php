<?php
//REMOVE POSSIVEIS ALERTAS
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '0');

//INICIA O SERVICO DE SESSOES
session_start();

//CARREGA UMA CONFIG EXTERNA
require 'classes/config.php';

//RECUPERA DADOS DA 'ACAO' VIA POST
$acao = '';
$acao = $_POST['acao'];

//RECUPERA DADOS DO 'NOME' VIA POST
$nome = '';
$nome = $_POST['nome'];

//RECUPERA DADOS DO 'SOBRENOME' VIA POST
$sobrenome = '';
$sobrenome = $_POST['sobrenome'];

//RECUPERA DADOS DO 'EMAIL' VIA POST
$email = '';
$email = $_POST['email'];

//RECUPERA DADOS DO 'CPF' VIA POST
$cpf = '';
$cpf = $_POST['cpf'];

//RECUPERA DADOS DO 'RG' VIA POST
$rg = '';
$rg = $_POST['rg'];

//RECUPERA DADOS DO 'TELEFONE' VIA POST
$telefone = '';
$telefone = $_POST['telefone'];

//RECUPERA DADOS DA 'DATANASC' VIA POST
$datanasc = '';
$datanasc = $_POST['datanasc'];

//RECUPERA DADOS DO 'SEXO' VIA POST
$sexo = '';
$sexo = $_POST['sexo'];

//RECUPERA DADOS DO 'CEP' VIA POST
$cep = '';
$cep = $_POST['cep'];

//RECUPERA DADOS DO 'UF' VIA POST
$uf = '';
$uf = $_POST['uf'];

//RECUPERA DADOS DA 'CIDADE' VIA POST
$cidade = '';
$cidade = $_POST['cidade'];

//RECUPERA DADOS DO 'BAIRRO' VIA POST
$bairro = '';
$bairro = $_POST['bairro'];

//RECUPERA DADOS DA 'RUA' VIA POST
$rua = '';
$rua = $_POST['rua'];

//RECUPERA DADOS DO 'COMPLEMENTO' VIA POST
$complemento = '';
$complemento = $_POST['complemento'];

//RECUPERA DADOS DO 'NUMERO' VIA POST
$numero = '';
$numero = $_POST['numero'];

//RECUPERA DADOS DA 'SENHA' VIA POST
$senha = '';
$senha = $_POST['senha'];

//RECUPERA DADOS DA 'CONFIRMARSENHA' VIA POST
$confirmarsenha = '';
$confirmarsenha = $_POST['confirmarsenha'];

//FUNCAO PARA VALIDAR CPF
function validaCPF($cpf = null) {

    // Verifica se um número NÃO É NULO
    if(empty($cpf)) {
        return false;
    }
    // Elimina possivel mascara
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||

        $cpf == '11111111111' ||

        $cpf == '22222222222' ||

        $cpf == '33333333333' ||

        $cpf == '44444444444' ||

        $cpf == '55555555555' ||

        $cpf == '66666666666' ||

        $cpf == '77777777777' ||

        $cpf == '88888888888' ||

        $cpf == '99999999999') {
        return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
    } else {
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }
}

//ATUALIZACAO DA FOTO DE PERFIL
if (isset($acao) && $acao == "foto"){

        $target_dir = "images/usuarios/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["$email"]);
        $uploadOk = 1;
        $imageFileType = getimagesize($_FILES["fileToUpload"]["tmp_name"])["mime"];

//VERIFICA SE NAO É A MESMA FOTO QUE A ATUAL OU UMA IMAGEM FALSA
        if(isset($_POST["atualizar"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "O arquivo é uma foto - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Este arquivo nao é uma foto.');window.location.href='minhaconta.php';</script>";
                die();
            }
        }

//VERIFICA SE O ARQUIVO JA EXISTE COM ESTE NOME
        if (file_exists($target_file)) {
            echo"<script language='javascript' type='text/javascript'>alert('Estamos substituindo sua foto antiga.');</script>";
            unlink($target_file);
        }

//VERIFICA O TAMANHO DO ARQUIVO, MAXIMO ACEITO 2MB

        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            echo"<script language='javascript' type='text/javascript'>alert('Aceitamos apenas arquivos abaixo de 2MB.');window.location.href='minhaconta.php';</script>";
        }

//PERMITE APENAS OS FORMATOS DE FOTOS
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "image/jpg" && $imageFileType != "image/png" && $imageFileType != "image/jpeg") {
            echo"<script language='javascript' type='text/javascript'>alert('Ops, somente aceitamos os formatos JPG, JPEG e PNG.');window.location.href='minhaconta.php';</script>";
        }

//VERIFICA SE NAO OCORREU NENHUM ERRO DURANTE A ATUALIZACAO

        if ($uploadOk == 0) {
            echo"<script language='javascript' type='text/javascript'>alert('Foi mal, sua foto nao foi atualizada.');window.location.href='minhaconta.php';</script>";

//SE TUDO ESTIVER OK, ATUALIZA A FOTO
        } else {
            $nomedafoto = $email.'.jpg';
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'images/usuarios/'. $nomedafoto)) {

                $update = "UPDATE cadastro SET foto = '$nomedafoto' WHERE email = '$email';";
                $result = $con->query($update);

                echo"<script language='javascript' type='text/javascript'>alert('Sua foto foi atualizada com sucesso!');window.location.href='minhaconta.php';</script>";
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Tivemos um problema ao atualizar a sua foto, tente novamente.');window.location.href='minhaconta.php';</script>";
            }
        }

        //ATUALIZACAO DA SENHA
}elseif (isset($acao) && $acao == "dados"){

    //VERIFICA SE AS SENHAS CONFEREM
    if ($senha != $confirmarsenha){

        echo"<script language='javascript' type='text/javascript'>alert('As senhas nao conferem.');window.location.href='minhaconta.php';</script>";

    }

    //UTILIZA A FUNCAO DE VERIFICAR O CPF
    if (!validaCPF($cpf)){

        echo"<script language='javascript' type='text/javascript'>alert('O CPF digitado não é valido, tente novamente.');window.location.href='minhaconta.php';</script>";

        die();

    }

    //ATUALIZA OS DADOS DO CLIENTE NO BANCO DE DADOS
    $update = "UPDATE cadastro SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', cpf = '$cpf', rg = '$rg', telefone = '$telefone', data_nasc = '$datanasc', sexo = '$sexo', cep = '$cep', estado = '$uf', cidade = '$cidade', bairro = '$bairro', rua = '$rua', complemento = '$complemento', numero = '$numero', email = '$email', senha = '$senha' WHERE email = '$email';";

    $result = $con->query($update);

    //VERIFICA SE EXECUTOU A QUERY NO BANCO DE DADOS
    if (!mysqli_query($con,$update)) {

        echo"<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar seu cadastro. ERRO 104". mysqli_error($con) ."');</script>";

    }

        echo"<script language='javascript' type='text/javascript'>alert('Cadastro atualizado com sucesso!');window.location.href='minhaconta.php';</script>";

    $con->close();

}else{

    echo"<script language='javascript' type='text/javascript'>alert('Ocorreu um erro. ERRO 103');window.location.href='minhaconta.php';</script>";

}
