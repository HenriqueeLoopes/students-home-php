<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '0');
session_start();
require 'classes/config.php';

if (isset($_POST['inserir'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $foto1 = $_FILES['foto1'];
    $nomefoto1 = $_POST['nomefoto1'];
    $foto2 = $_FILES['foto2'];
    $nomefoto1 = $_POST['nomefoto2'];
    $foto3 = $_FILES['foto3'];
    $nomefoto1 = $_POST['nomefoto3'];
    $foto4 = $_FILES['foto4'];
    $nomefoto1 = $_POST['nomefoto4'];
    $avaliacao = $_POST['avaliacao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];

    $proximo_id = $con->query("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'veronasa_tcc' AND TABLE_NAME = 'hospedagens';")->fetch_assoc()['AUTO_INCREMENT'];
    $sql = $con->query("INSERT INTO hospedagens(nome_hospedagem, descricao_hospedagem, avaliacao, preco, id_categoria, id_tipo, id_estado, id_cidade) VALUES ('{$nome}', '{$descricao}', '{$avaliacao}', '{$preco}', '{$categoria}', '{$tipo}', '{$estado}', '{$cidade}');");

    $target_dir = "images/hospedagens";
    $foto1 = $target_dir.basename($foto1["$nomefoto1"]);
    $foto2 = $target_dir.basename($foto2["$nomefoto2"]);
    $foto3 = $target_dir.basename($foto3["$nomefoto3"]);
    $foto4 = $target_dir.basename($foto4["$nomefoto4"]);

    if ($foto1["size"] > 2000000 && $foto2["size"] > 2000000 && $foto3["size"] > 2000000 && $foto4["size"] > 2000000) {
        echo"<script language='javascript' type='text/javascript'>alert('Aceitamos apenas arquivos abaixo de 2MB.');window.location.href='backend.php';</script>";
    }
    if (move_uploaded_file($foto1["tmp_name"], 'images/hospedagens/'. $nomedafoto1)) {
        $con->query("UPDATE hospedagens SET foto_hospedagem = '$nomedafoto1' WHERE id_hospedagem = '{$proximo_id}';");
    } else {
        echo"<script language='javascript' type='text/javascript'>alert('ERRO FATAL FOTO HOSPEDAGEM 1.');window.location.href='backend.php';</script>";
    }
    if (move_uploaded_file($foto2["tmp_name"], 'images/hospedagens/'. $nomedafoto2)) {
        $con->query("UPDATE hospedagens SET foto1_hospedagem = '$nomedafoto2' WHERE id_hospedagem = '{$proximo_id}';");
    } else {
        echo"<script language='javascript' type='text/javascript'>alert('ERRO FATAL FOTO HOSPEDAGEM 2.');window.location.href='backend.php';</script>";
    }
    if (move_uploaded_file($foto3["tmp_name"], 'images/hospedagens/'. $nomedafoto3)) {
        $con->query("UPDATE hospedagens SET foto2_hospedagem = '$nomedafoto3' WHERE id_hospedagem = '{$proximo_id}';");
    } else {
        echo"<script language='javascript' type='text/javascript'>alert('ERRO FATAL FOTO HOSPEDAGEM 3.');window.location.href='backend.php';</script>";
    }
    if (move_uploaded_file($foto4["tmp_name"], 'images/hospedagens/'. $nomedafoto4)) {
        $con->query("UPDATE hospedagens SET foto3_hospedagem = '$nomedafoto4' WHERE id_hospedagem = '{$proximo_id}';");
    } else {
        echo"<script language='javascript' type='text/javascript'>alert('ERRO FATAL FOTO HOSPEDAGEM 4.');window.location.href='backend.php';</script>";
    }
}
?>
<form action="backend.php" method="post">
    <label for="nome">Nome da hospedagem:</label>
    <input type="text" id="nome" name="nome" required size="45" maxlength="45"><br><br>

    <label for="descricao">Descricao da hospedagem:</label>
    <input type="text" id="descricao" name="descricao" required size="70" maxlength="70"><br><br>

    <label for="nomefoto1">Nome da foto1 da hospedagem:</label>
    <input type="text" id="nomefoto1" name="nomefoto1" required size="20" maxlength="20"><br>
    <label for="foto1">Foto 1 da hospedagem:</label><br>
    <input type="file" name="foto1" id="foto1" required><br><br>

    <label for="nomefoto2">Nome da foto2 da hospedagem:</label>
    <input type="text" id="nomefoto2" name="nomefoto2" required size="20" maxlength="20"><br>
    <label for="foto2">Foto 2 da hospedagem:</label><br>
    <input type="file" name="foto2" id="foto2" required><br><br>

    <label for="nomefoto3">Nome da foto3 da hospedagem:</label>
    <input type="text" id="nomefoto3" name="nomefoto3" required size="20" maxlength="20"><br>
    <label for="foto3">Foto 3 da hospedagem:</label><br>
    <input type="file" name="foto3" id="foto3" required><br><br>

    <label for="nomefot4">Nome da foto4 da hospedagem:</label>
    <input type="text" id="nomefoto4" name="nomefoto4" required size="20" maxlength="20"><br>
    <label for="foto4">Foto 4 da hospedagem:</label><br>
    <input type="file" name="foto4" id="foto4" required><br><br>

    <label for="avaliacao">Avaliacao da hospedagem:</label>
    <input type="number" id="avaliacao" name="avaliacao" required size="3" maxlength="3"><br><br>

    <label for="preco">Preço da hospedagem:</label>
    <input type="number" id="preco" name="preco" required size="8" maxlength="8"><br><br>

    <label for="categoria">ID Categoria:</label>
    <input type="number" id="categoria" name="categoria" required size="70" maxlength="70"><br><br>

    <label for="tipo">ID Tipo:</label>
    <input type="number" id="tipo" name="tipo" required size="70" maxlength="70"><br><br>

    <label for="estado">ID Estado:</label>
    <input type="number" id="estado" name="estado" required size="70" maxlength="70"><br><br>

    <label for="cidade">ID Cidade:</label>
    <input type="number" id="cidade" name="cidade" required size="70" maxlength="70"><br><br>

    <button type="submit" name="inserir" id="inserir">Inserir (Tem certeza dos campos preenchidos ?)</button>
</form>