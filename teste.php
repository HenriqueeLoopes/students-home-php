<?php

$nome = "Henrique";
$sobrenome = "Lopes";
$email = "henriquegamer83@gmail.com";
$senha = 'emerenciana229';
$id_usuario = 1;

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

$headers = "From: admin@studentshome.tk\r\n";
$headers .= "Reply-To: admin@studentshome.tk\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

if (mail($email, $subject, $message, $headers)){
    echo "Email enviado com sucesso!";
}else{
    echo "Erro!";
}
?>