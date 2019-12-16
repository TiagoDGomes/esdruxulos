<?php

abstract class Exibicao {

    static function exibirFormularioComentario($h) {
        global $USUARIO;
        HTML::startFieldSet("Escreva o seu comentário");
        // <editor-fold defaultstate="collapsed" desc="Se o usuário for cadastrado e estiver logado, ele poderá postar comentário.">
        if ($USUARIO->getSenhaMD5Hash()!="") {
            HTML::startForm("/post.php", "post");
            echo '<table>';
            echo '<tr><td>Seu nome: </td><td>'. $USUARIO->getNome().'</td></tr>';
            echo '<tr><td>Comentário: </td><td>'.HTML::createTextArea("comentario", "comentario").'</td></tr>';
            ?>
<tr><td>Sua nota:</td><td><?php
                    Listagem::exibirNotasEstrelasVoto();
                    ?></td></tr>
<tr>
    <td>&nbsp;</td>
    <td>
                    <?php
                    echo HTML::createSubmitButton("enviar", "Enviar",$disabled)
                    ?>
    </td>
</tr>
            <?php
            echo '</table>';
            echo HTML::createHiddenInput("historia", $h->getID());
            HTML::closeForm();
        }// </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="Senão, uma mensagem dirá que ele precisará logar no site.">
        else {
            ?><p>Você precisa logar para postar comentários.</p>
<p>Clique <a href="/clube/login.html">aqui</a> para ir à tela de login do fã clube.</p>
<br>
            <?php
        }// </editor-fold>
        HTML::closeFieldSet();
    }

    public static function exibirMenuPrincipal() {
        // <editor-fold defaultstate="collapsed" desc="Insere o menu principal">

        ?>

        <?php

// </editor-fold>
    }

    public static function tratarLinkReferencia() {
        // <editor-fold defaultstate="collapsed" desc="Trata os links de referencia, como orkut e twitter.">
        $url = explode("/", $_GET['url']);
        if ($url[0] == 'ir') {
            switch ($url[1]) {
                case 'orkut':
                    $link='http://www.orkut.com/';
                    break;
                case 'twitter':
                    $link = 'http://www.twitter.com/';
                    break;
                default:
            }
            header("Location: $link");
        }
        // </editor-fold>
    }

    public static function exibirQuemSomos() {
        include 'html/quemsomos.html';
    }
    public static function exibirPropagandaTopo() {
        echo '<img src="/img/propaganda.jpg" alt="" width="190" height="90" />' ;
    }
    public static function exibirPaginaInicial() {
        include 'html/inicio.html';
    }

    public static function exibirFormularioContato() {
        include 'html/contato.php';
    }
//    public static function exibirPersonagem() {
//
//
//    }
//    static function exibirTira() {
//        include 'html/tira.php';
//    }
//    public static function exibirHistoria() {
//        include 'html/historia.php';
//    }


}
?>
