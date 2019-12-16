<?php
include 'system.php';
$USUARIO = new Usuario();
    try {
        $USUARIO->carregarPorCookie($_COOKIE['uidxdr']);
        $r = Criacao::ComentarioPorPostMethod();
        if ($r=="ok"){
        $MENSAGEM = '<p>Seu comentario foi enviado.</p>'.
                        '<p> Clique <a href="/">aqui</a> para ir a pagina inicial.<br>';
        }
        else
            {
            $MENSAGEM = "<p> Erro ao postar comentario</p><p></p>";
        }

    } catch (Exception $exc) {


    }
?>
<html>
    <head>
       <link rel="stylesheet" type="text/css" media="screen" href="/layout/mensagem.css" />

    </head>
    <body>
        <div class="msgbox" >
            <div class="msgboxTitle">Comentario</div>
            <div class="msgboxContent"><?php echo $MENSAGEM; ?></div>
        </div>
    </body>
</html>