<?php
// <editor-fold defaultstate="collapsed" desc="Iniciar">
include "system.php";
$url = explode("/", $_GET['url']);
$USUARIO = new Usuario();
if ($_GET['logout']=='yes') {
    setcookie('uidxdr', '');
}else {
    try {
        $USUARIO->carregarPorCookie($_COOKIE['uidxdr']);


    } catch (Exception $exc) {
        srand();
        $USUARIO->setLogin(md5(rand(1, 32767)));
        $USUARIO->setCookie(md5(rand(1, 32767)));
        $USUARIO->salvar();
        $USUARIO->setLogin(md5($USUARIO->getID()));

    }
    $USUARIO->hitVisita();
    $anoQueVem = time()+60*60*24*365;
    setcookie('uidxdr', $USUARIO->getCookie(),$anoQueVem,"/");

}


// </editor-fold>

$estado = new Estado();
$estado->carregarPorID($_POST['idEstado']);

$USUARIO->setNome($_POST['nome']);
$USUARIO->setEndereco($_POST['endereco']);
$USUARIO->setEmail($_POST['email']);
$USUARIO->setBairro($_POST['bairro']);
$USUARIO->setCelular($_POST['celular']);
$USUARIO->setCidade($_POST['cidade']);
$USUARIO->setSenha($_POST['senhaC']);
$USUARIO->setEstado($estado);
$USUARIO->setTelefone($_POST['telefone']);
$USUARIO->setDataNascimento($_POST['anoNasc'].'-'.$_POST['mesNasc'].'-'.$_POST['diaNasc']);
$USUARIO->setSexo($_POST['sexo']);
$USUARIO->setCookie($_COOKIE['uidxdr']);
if (Usuario::checkLoginNameExists($_POST['login'])=="") {

    $USUARIO->setLogin($_POST['loginC']);
    $USUARIO->salvar();
    $MENSAGEM = 'Seu cadastro foi concluido com sucesso<br>';
    $MENSAGEM .= 'Clique <a href="/">aqui</a> para ir a pagina inicial.<br>';

}else {
    $MENSAGEM = 'Você não pode usar este login.';
}
?>
<html>
    <head>
       <link rel="stylesheet" type="text/css" media="screen" href="/layout/mensagem.css" />

    </head>
    <body>
        <div class="msgbox" >
            <div class="msgboxTitle">Cadastro</div>
            <div class="msgboxContent"><?php echo $MENSAGEM; ?></div>
        </div>
    </body>
</html>