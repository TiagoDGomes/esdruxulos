<?php
include 'system.php';

$url = explode('/', $_GET['url']);
//echo $url[0];
//echo $url[1];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css">
            body {font-family:tahoma; font-size:small;}
        </style>
    </head>
    <body>

        <pre>
            <?php
            $p = new Anunciante();
//                        $h = new Historia();
//                        $h->carregarPorID(1);
//                        echo $h->getPersonagem(1)->getNome();
//                        echo $h->getPagina(0)->getCaminho();
//                        echo $h->getComentario(0)->getConteudo();
//                        echo $h->getFormato()->getNome();
//                        echo $h->getHumor(0)->getDescricao();
//                        $p =new Personagem();
//                        $p->carregarPorID(1);
//                        echo $p->getHistoria(0)->getTitulo();
//                        $h = new Humor();
//                        $h->carregarPorID(1);
//                        echo $h->getHistoria(0)->getTitulo();
//                        echo $h->getPropaganda(0)->getNome();
//                        $p = new Propaganda();
//                        $p->carregarPorID(1);
//                        echo $p->getAnunciante()->getRazaoSocial();
//                        $f = new Formato();
//                        $f->carregarPorID(1);
//                        echo $f->getHistoria(0)->getTitulo();
//                        $u = new Usuario();
//                        $u->carregarPorID(1);
//                        echo $u->getComentario(1)->getConteudo();
//                        echo $u->getPreferencia(0)->getNome();
//                        $h = new Historia();
//                        $h->carregarPorID(1);
//                        echo $h->getPagina(0)->getCaminho();
//                        echo $h->getComentario(0)->getConteudo();
//                        $u = new Usuario();
//                        $u->carregarPorID(1);
//                        echo $u->getPreferencia(0)->getNome();
//                        $h  = new Historia();
//                        $h->carregarPorID(1);
//                        echo $h->countHumor();
//                        ////testar setorprofissional
//                          $u = new Usuario();
//                          $u->carregarPorID(1);
//                          echo $u->getSetorProfissional()->getNome();
//                          echo SetorProfissional::count();
//                          $e = new Estado();
//                          $e->carregarPorID("SP");
//                          echo $e->getNome();
//            $h = new Historia();
//            $f = new Formato();
//            $f->carregarPorID(1);
//            $h->carregarPorID(3);
//            echo "Get: ".$h->getTitulo();
//            $h->setTitulo("Meu novo titulo");
//            $h->setFormato($f);
//            $h->setDataInsercao(bd::now());
//            $h->setDescricao("Nova descrição");
//            echo "<br>Setado: ".$h->getTitulo()."<br>";
//            $h->salvar();
//            unset($h);
//            $h = new Historia();
//            $h->carregarPorID(1);
//            echo "<br>BD: ".$h->getTitulo()."<br>";
//            print_r( bd::max("id", "historia"));
//
//            /   Teste salvar comentario
//            $h = new Historia();
//            $f = new Formato();
//            $u = new Usuario();
//
//
//            $f->carregarPorValorAtributo("nome", "Quadrinho");
//            $h->setFormato($f);
//
//            $hm = new Humor();
//            $hm->carregarPorID(1);
//            $hm2 = new Humor();
//            $hm2->carregarPorID(2);
//
//            $h->setHumor(0, $hm);
//            $h->setHumor(1, $hm2);
//
//            $h->salvar();
//
//            $p = new Pagina();
//            $p->setCaminho("123");
//            $p->setHistoria($h);
//            $p->salvar();
////
//            $u = new Usuario();
//            $u->salvar();
//
//            $c = new Comentario();
//            $c->setConteudo("meu comentario esdruxulo");
//            $c->setHistoria($h);
//            $c->setUsuario($u);
//            $c->salvar();
//
//            $h = new Historia();
//            $h->carregarPorID(1);
//            $u = new Usuario();
//            $u->carregarPorID(1);
//            $c = new Comentario();
//            $c->setConteudo("hehe comentario esdruxulo");
//            $c->setHistoria($h);
//            $c->setUsuario($u);
//            $c->salvar();

////            Testar salvar setor profissional
//            $p = new SetorProfissional();
//            $p->carregarPorID(3);
//            $p->setNome("Vagabundeador");
//            $p->salvar();
////            OK
//            //Testar salvar estado
//            $e = new Estado();
//            $e->carregarPorID(29);
//            $e->setCodigo("TP");
//            $e->setNome("Tangamandapio");
//            $e->salvar();
//            //OK
//
//            echo TCP::getServerIP();
//$p = new Preferencia();
//$h = new Humor();
//
//$p->setNome("Pornografia");
//$p->salvar();
//$h->setPreferencia(0, $p);
//$h->setNome("Erotismo");
//$h->salvar();
////
////$p->setHumor(0, $h);
////$p->salvar();

//
//$p = new Propaganda();
//$a = new Anunciante();
//$a->setRazaoSocial("Empresa ficticia");
//$a->salvar();
//$p->setConteudo("bla");
//$p->setAnunciante($a);
//$p->salvar();
//            $a = new Anunciante();
//            $a->setRazaoSocial("Coca-cola");
//            $a->setWebsite("http://www.coca-cola.com.br");
//            $a->salvar();
//
//            $b = new Anunciante();
//            $b->carregarPorID(1);
//            echo $b->getRazaoSocial();
           ?>
        </pre>
<?php
//$hl = Historia::pesquisar("pa");
//foreach($hl as $h){
//    echo "<h1>".$h->getTitulo()."</h1><p>".$h->getDescricao()."</p>";
//}
//$h = new Historia();
//try {
//    $h->carregarPorID(2);
//} catch (Exception $exc) {
//    echo $exc->getTraceAsString();
//}
//
//$h->excluir();
////
//$usuario_qv = new Usuario();
//$usuario_qv->salvar();
//Navegacao::exibirListaHistorias($usuario_qv);
//Navegacao::exibirListaPersonagens($usuario_qv);
//
////
//$h = new Historia();
//$h->carregarPorValorAtributo("titulo", "Historia padrao");
//echo $h->getPagina(1)->getIndice();
////
//echo HTML::createImgTag("http://tdg.myvnc.com:8080/php_info.php?=PHPE9568F34-D428-11d2-A769-00AA001ACF42","php")

$p = new Propaganda();
$p->carregarPorID(2);
echo $p->getConteudo();
?>



    </body>
</html>
