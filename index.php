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

Exibicao::tratarLinkReferencia();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Modificar título">
switch ($url[0]) {
    case 'index':
        $TITULO = "Página inicial" ;
        break;
    case 'historia':
        if (is_numeric($url[2]) ) {
            try {
                $h = new Historia();
                $h->carregarPorID($url[2]);
                $TITULO=$h->getTitulo();
            } catch (Exception $exc) {
                $TITULO = "Oops!";
            }
        }else {
            $TITULO = $url[1];
        }
        break;
    case 'clube':
        $TITULO = 'Fã clube';
        break;
    case 'quemsomos':
        $TITULO = "Quem somos";
        break;
    case 'personagem':
        $TITULO = "Personagens";
        break;
    case 'pesquisa':
        if ($_GET['q']!='') {
            $TITULO = 'pesquisar por ' & $_GET['q'];
        }
        else {
            $TITULO = 'Pesquisa';
        }
        break;
}
if ($TITULO!="") $TITULO = $SITE_TITLE . ' - ' . $TITULO;
else $TITULO = $SITE_TITLE;// </editor-fold>

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
    <head>
        <meta name="author" content="Hellynson Cassio Lana;Tiago Donizetti Gomes" />
        <meta lang="pt-br" name="description" content="Quadrinhos para todos os tipos de humor" />
        <meta name="keywords" content="quadrinhos, esdr&uacute;xulos, humor, entretenimento, tiras"  />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="alternate" type="application/rss+xml" href="/rss/historias.rss" title="Os esdr&uacute;xulos - Hist&oacute;rias" />
        <link rel="stylesheet" type="text/css" media="screen" href="/layout/screen.css" />
        <link rel="stylesheet" type="text/css" media="print" href="/layout/print.css" />
        <link rel="stylesheet" type="text/css" media="handheld" href="/layout/handheld.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/layout/default.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/layout/hell.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/layout/tiago.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/layout/test.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/layout/quadrinho.css" />
        <link rel="stylesheet" type="text/css" href="/js/cycle/cycle.css" />
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.easing.1.1.1.js"></script>
        <script type="text/javascript" src="/js/chili-1.7.pack.js"></script>
        <script type="text/javascript" src="/js/cycle/jquery.cycle.all.latest.js"></script>
        <title><?php echo $TITULO; ?></title>
    </head>
    <body>
        <div style="display: none; position: absolute" id="miniLogin" title="Login">
            <p>Nome: </p>
            <p>Senha:</p>
        </div>
        <div id="dMain">
            <div id="dTitulo">
                <div id="dMensagemBemVindo">
                    Bem-vindo, <?php
                    // <editor-fold defaultstate="collapsed" desc="Exibir o nome do usuário e opções de login">
                    if ($USUARIO->getSenhaMD5Hash()=="") {
                        ?>visitante<br />

                    <span class="opcoesLogin">
                        Clique <a id="linkEntrar" href="/clube/login.html">aqui</a> para entrar.
                    </span>
                    <div class="loginBemVindo"  style="display: none">
                        <form action="/login.php" method="post">
                            <span>Nome: <input name="nomeUsuario" type="text" size="25" /></span><br />
                            <span>Senha: <input name="senhaUsuario" type="text" size="25" /></span>

                        </form>
                    </div>

                        <?php

                    }else {
                        echo $USUARIO->getNome();
                        echo "<br /><span class=\"opcoesLogin\">Clique ".HTML::createLink('/?logout=yes', 'aqui'). ' para sair.</span>';
                    }// </editor-fold>
                    ?>
                </div>
                <h1>Os esdrúxulos</h1>
                <div id="dBusca">

                    <form name="buscaTopo" id="buscaTopo" action="/pesquisa.html" method="post" onsubmit="pesquisar()">
                        <div><span class="linkBusca"><a href="/pesquisa.html">Busca</a>: </span><input class="caixaBusca" type="text" id="q" name="q" />
                            <input type="hidden" name="b" value="all" />
                            <input id="botaoBuscar" type="submit" value="Buscar" />
                            <span class="linkBotaoBusca"><a href="#" onclick="pesquisar()"><img alt="" src="/img/b.gif" /></a></span>
                        </div>
                    </form>                    
                    <script type="text/javascript">
                        function pesquisar(){
                            var busca = document.buscaTopo;
                            var q = document.buscaTopo.q.value;
                            busca.action = "/pesquisa/palavra/"+q+".html"
                            busca.submit();
                        }
                    </script>
                </div>
                <div id="dMenu">
                    <div id="dMenuLista" >
                        <ul id="dlMenu">
                            <li><span id="mInicio" class="mBalao"></span><a href="/index.html">In&iacute;cio</a> | </li>
                            <li><span id="mQuadrinhos" class="mBalao"></span><a href="/historia/quadrinho/index.html">Quadrinhos</a>  | </li>
                            <li><span id="mTiras" class="mBalao"></span><a href="/historia/tira/index.html">Tiras</a> | </li>
                            <li><span id="mPersonagens" class="mBalao"></span> <a href="/personagem/index.html">Personagens</a>| </li>
                            <li><span id="mClube" class="mBalao"></span><a href="/clube/index.html">F&atilde; clube</a> | </li>
                            <li><span id="mOrkut" class="mBalao"></span><a href="/ir/orkut.html">Orkut</a> | </li>
                            <li><span id="mTwitter" class="mBalao"></span><a href="/ir/twitter.html">Twitter</a> | </li>
                            <li><span id="mContato" class="mBalao"></span><a href="/contato/index.html">Fale conosco</a> | </li>
                            <li><span id="mQuemSomos" class="mBalao"></span><a href="/quemsomos/index.html">Quem somos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="dPropaganda" >
                <?php Exibicao::exibirPropagandaTopo(); ?>
            </div>


            <div id="dPrincipal">
                <div id="dPropagandaLado">
                    <?php
                    // <editor-fold defaultstate="collapsed" desc="Propaganda lateral">
                    if (Propaganda::count()>0) {
                        for ($p = 0; $p<6 ;$p++) {
                            echo '<div>';
                            echo Propaganda::getPropagandaAleatoria($USUARIO)->getConteudo();
                            echo '</div>';
                        }
                    }// </editor-fold>
                    ?>
                </div>    
                <?php
                // <editor-fold defaultstate="collapsed" desc="Exibe o conteudo conforme a solicitação feita pelo usuario.">

                $url = explode("/", $_GET['url']);
                switch ($url[0]) {
                    // <editor-fold defaultstate="collapsed" desc="Caso seja história...">
                    case 'historia':
                        $f = new Formato();
                        $h = new Historia();
                        switch ($url[1]) {
                            case 'quadrinho':
                                if ($url[2]=='index') {
                                    $f->carregarPorValorAtributo('nome', 'quadrinho');
                                    Historia::mostrarListaHistoriasParaUsuario($f);

                                }else {
                                    try {
                                        $h->carregarPorID($url[2]);
                                        $USUARIO->navegaEmHistoria($h);
                                        $h->mostrarHistoriaParaUsuario();
                                    } catch (Exception $exc) {
                                        new Mensagem("Quadrinho não encontrado.", "h2");
                                        new Mensagem("Verifique se o endereço está correto.", "p");
                                    }
                                }
                                break;
                    // </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja tira...">
                            case 'tira':
                                if ($url[2]=='index') {
                                    $f->carregarPorValorAtributo('nome', 'tira');
                                    Historia::mostrarListaHistoriasParaUsuario($f);

                                }else {
                                    try {
                                        $h->carregarPorID($url[2]);
                                        $USUARIO->navegaEmHistoria($h);
                                        $h->mostrarHistoriaParaUsuario();
                                    } catch (Exception $exc) {
                                        new Mensagem("Tira não encontrada.", "h2");
                                        new Mensagem("Verifique se o endereço está correto.", "p");
                                    }
                                }
                                break;
                        }
                        break;// </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja personagem...">
                    case 'personagem':
                        switch ($url[1]) {
                            case 'index':
                                Personagem::mostrarListaPersonagensParaUsuario();
                                break;

                            default:
                            //Exibicao::exibirPersonagem();
                                $p = new Personagem();
                                try {
                                    $p->carregarPorID($url[1]);
                                    $p->mostrarPersonagemParaUsuario();
                                }
                                catch (Exception $e) {

                                }

                                Personagem::mostrarListaPersonagensParaUsuario();
                                break;
                        }

                        break;// </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja clube...">
                    case 'clube':
                        include 'html/clube.php';
                        break;// </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja contato...">
                    case 'contato':
                        Exibicao::exibirFormularioContato();
                        break;// </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja Quem Somos...">
                    case 'quemsomos':
                        Exibicao::exibirQuemSomos();
                        break;// </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja postar comentário...">
                    case 'postar':
                        Criacao::ComentarioPorPostMethod();
                        
                        break;
                    // </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja pesquisa...">
                    case 'pesquisa':


                        ?>

                <div>
                    <div id="dCaixaDePesquisa">
                        <script type="text/javascript">
                            function fPesquisaAvancada(){
                                var formulario = document.pesquisaAvancada;
                                formulario.action = '/pesquisa/palavra/'+formulario.q.value + '.html';

                            }
                        </script>

                        <form id="pesquisaAvancada" name="pesquisaAvancada" action="#" method="post" onsubmit="fPesquisaAvancada()">
                            <div>
                                <span class="titulo">
                                    Pesquisa: </span>
                                <span class="pesquisa">
                                    <input type="text" name="q" value="<?php echo $url[2] ?>" />
                                    <input type="hidden" name="b" value="none" />
                                </span>
                                <span class="botaoPesquisa">

                                    <input type="submit" value="Pesquisar" /></span>
                            </div>
                            <div id="opcoesAvancadas">
                                <div>
                                    <input id="h" type="checkbox" name="h"  <?php if(($_POST['h']=='on')||$_POST['b']=='all'||($_POST['b']==''))  echo 'checked="checked"' ?> /><label for="h">Histórias</label>
                                    <input id="p" type="checkbox" name="p"  <?php if(($_POST['p']=='on')||$_POST['b']=='all'||($_POST['b']==''))  echo 'checked="checked"' ?> /><label for="p">Personagens</label>
                                </div>
                            </div>
                        </form>
                    </div>
                            <?php

                            switch ($url[1]) {
                                case 'palavra':
                                    if ($url[2]!="") {
                                        ?>

                    <div class="resultadoBarTopo">

                    </div>
                    <div id="dResultadoContainer">
                                            <?php

                                            if (($_POST['h']=='on')||$_POST['b']=='all'||($_POST['b']=='')) {
                                                $hids = Historia::getListID(" where titulo like '%".addslashes($url[2])."%' or descricao like '%".addslashes($url[2])."%'" );
                                                if (count($hids)>0) {
                                                    foreach ($hids as $hid) {
                                                        $h = new Historia();
                                                        $h->carregarPorID($hid);
                                                        $h->mostrarHistoriaComoResultadoDeBusca($url[2]);
                                                    }
                                                }
                                            }
                                            if (($_POST['h']=='on')||$_POST['b']=='all'||($_POST['b']=='')) {
                                                $pids = Personagem::getListID(" where nome like '%".addslashes($url[2])."%' or descricao like '%".addslashes($url[2])."%'");
                                                if (count($pids)>0) {
                                                    foreach ($pids as $pid) {
                                                        $p = new Personagem();
                                                        $p->carregarPorID($pid);
                                                        $p->mostrarPersonagemComoResultadoDeBusca($url[2]);
                                                    }
                                                }

                                            }
                                            ?>

                    </div>
                    <div class="resultadoBarTopo">
                        Sua pesquisa encontrou <?php echo count($hids) . " história"; if (count($hids)!=1) echo 's'; ?>  e <?php echo count($pids)." personage";if (count($pids)!=1) echo 'ns';else echo 'm'; ?> com o termo <strong><?php echo $url[2] ?></strong>.
                    </div>

                                        <?php
                                    }

                            }
                            ?>
                </div>
                        <?php
                        break;
                    // </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Caso seja RSS...">
                    case 'rss':
                        include 'html/rss.php';
                        break;
                    // </editor-fold>

                    case 'index':
                    case '':
                        Exibicao::exibirPaginaInicial();
                        break;
                    default:


                }// </editor-fold>
                ?>
            </div>
            <div id="dRodape">
                <address>
                    <a href="/rss/index.html"><img src="/img/rss_logo.gif" alt="rss" /></a><br />
                    <a href="/">&copy; Os Esdrúxulos - Copyright 2010</a><br />
                    <span>Este site é feito com:
                        <!--<a target="_blank" href="http://www.google.com/analytics">Google Analitycs</a> - -->
                        <a target="_blank" href="http://jquery.com/">JQuery</a> -
                        <a target="_blank" href="http://jquery.malsup.com/cycle/">JQuery Cycle</a>
                        
                    </span>
                </address>
            </div>
        </div>
    </body>
</html>
<?php
$USUARIO->salvar();
?>

