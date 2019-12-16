<?php
include 'system.php';
$USUARIO = new Usuario();
try {
    $USUARIO->carregarPorLoginSenha($_POST['nomeUsuario'], $_POST['senhaUsuario']);
    $MENSAGEM = "<p>Bem vindo $USUARIO</p>
                <p>Clique <a href=\"/\">aqui</a> para continuar</p>";
    setcookie('uidxdr', $USUARIO->getCookie());

} catch (Exception $exc) {
    $MENSAGEM='<p>Erro ao tentar logar. </p>
        <p> Nome de usuario ou senha invalidos</p>
        <p>Clique <a href="javascript:history.go(-1)">aqui</a> para voltar</p>';
}

?>
<html>
    <head>
       <link rel="stylesheet" type="text/css" media="screen" href="/layout/mensagem.css" />

    </head>
    <body>
        <div class="msgbox" >
            <div class="msgboxTitle">Login</div>
            <div class="msgboxContent"><?php echo $MENSAGEM; ?></div>
        </div>
    </body>
</html>