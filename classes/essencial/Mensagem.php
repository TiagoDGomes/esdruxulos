<?php

class Mensagem {
    function __construct($mensagem, $tag,$tipo="") {
        if ($tipo!="")$tipo=HTML::createImgTag("/admin/img/Ball-$tipo-16.png", "info");
        echo "<$tag>$tipo  $mensagem</$tag>";
    }

}
?>
