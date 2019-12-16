<?php
// <editor-fold defaultstate="collapsed" desc="Autenticação">
include 'system.php';
//  Nome de usuário do banco de dados para o administrador
//$SITE_DB_USERNAME= "xdrxladmin";
//$SITE_DB_USERNAME= "root";
//  Senha do banco de dados do administrador
//$SITE_DB_PASSWORD= "";

if (($_SERVER['PHP_AUTH_USER']!=$SITE_ADMIN_USERNAME) ||
        ($_SERVER['PHP_AUTH_PW']!=$SITE_ADMIN_PASSWORD) ) {
    header('WWW-Authenticate: Basic realm="Os esdruxulos - Administracao do site"');
    header('HTTP/1.0 401 Unauthorized');
    
    echo '<html><head></head><body><h1>Autoriza&ccedil;&atilde;o requerida</h1><p>Por favor, informe o nome de usu&aacute;rio e senha.</p></body></html>';
    exit;
}// </editor-fold>
if (($_GET['secao']=='opcoesSite')
        && ($_GET['opcao']=='backup')
        && ($_GET['ok']=='yes')) {
    include 'admin/secao/opcoesSite.php';

}
else {

    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html  lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet"  type="text/css" href="/admin/style.css">
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/admin/greybox/greybox.js"></script>
        <script type="text/javascript" src="/admin/jquery.MultiFile.js"></script>
        <link rel="stylesheet" type="text/css" href="/admin/greybox/greybox.css">
        <title>Os esdr&uacute;xulos - Administraç&atilde;o</title>
        <script type="text/javascript">
            var GB_ANIMATION = true;
            $(document).ready(function(){
                $("a.greybox").click(function(){
                    var t = this.title || $(this).text() || this.href;
                    GB_show(t,this.href,470,600);
                    return false;
                });
            });
        </script>
    
    </head>
    <body>
        <div id="main">
            <h1 id="tituloPrincipal"><a href="?">Os Esdr&uacute;xulos - Painel de controle</a></h1>
            <div id="menu">
                    <?php
                    include "admin/menu.php";
                    ?>
            </div>
            <div id="conteudo">
                    <?php
                    switch($_GET["secao"]) {
                        case "historia":
                        case "personagem":
                        case "anunciante":
                        case "propaganda":
                        case "preferencia":
                        case "opcoesAdmin":
                        case "opcoesSite":
                        case "humor":
                        case "teste":

                        case "usuario":
                            include "admin/secao/".$_GET['secao'].".php";
                            break;

                        default:
                        //bd::checkConnection();
                            include "admin/secao/bemvindo.php";
                    }
                    ?>
            </div>
            <address>Sistema para administra&ccedil;&atilde;o do site &quot;Os Esdr&uacute;xulos&quot; - &copy; Copyright 2010</address>
        </div>
        
    </body>
</html>
    <?php
}
?>