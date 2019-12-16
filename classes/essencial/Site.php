<?php
/**
 *
 */
class Site {

    private $url;

    /**
     * O usuário que está navegando no site
     * @var Usuario
     */
    private $usuario;

    /**
     * O objeto que está sendo navegado
     * @var ItemSite
     */
    private $objetoDeNavegacao;

    /**
     * Titulo do site
     * @var String
     *
     */
    private $titulo;

    /**
     * Usuário do site
     * @return Usuario
     */

    public function getURLArray($index){
        return $url[$index];
    }
    public function getUsuario() {
        return $this->usuario;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getObjetoDeNavegacao(){
        return $this->objetoDeNavegacao;
    }
    /**
     * Retorna uma string referente a navegação
     * @return String
     */
    public function getSecaoDeNavegacao() {
        return $this->url[0];
    }


    public function __construct() {
        $this->url = explode("/", $_GET['url']);
        $this->usuario = new Usuario();
        try {
            $this->usuario->carregarPorCookie($_COOKIE['uidxdr']);
            $this->usuario->setCookie(md5(rand(1, 32767)));
            //setcookie("c", "ok");

        } catch (Exception $exc) {
            srand();
            $this->usuario->setLogin(md5(rand(1, 32767)));
            $this->usuario->setCookie(md5(rand(1, 32767)));
            $this->usuario->salvar();
            $this->usuario->setLogin(md5($this->usuario->getID()));
            //setcookie("c", "none");
        }
        setcookie('uidxdr', $this->usuario->getCookie(),time()+60*60*24*365,"/");
        switch ($this->getSecaoDeNavegacao()) {
            case 'index':
                $TITULO = "Página inicial" ;
                break;
            case 'historia':

                if (is_numeric($url[2]) ) {
                    try {
                        $h = new Historia();
                        $h->carregarPorID($url[2]);
                        $this->titulo=$h->getTitulo();
                    } catch (Exception $exc) {
                        $this->titulo = "Não encontrado";
                    }

                }else {
                    $this->titulo = $url[1];
                }
                $this->objetoDeNavegacao = $h;
                break;
            case 'clube':
                $this->titulo = 'Fã clube';

                break;
            case 'quemsomos':
                $this->titulo = "Quem somos";
                break;
            case 'personagem':
                $this->titulo = "Personagens";
                $this->objetoDeNavegacao = new Personagem();
                break;
            case 'ir':
                
                break;
        }
        global $SITE_TITLE;
        if ($this->titulo!="") $this->titulo = $SITE_TITLE . ' - ' . $this->titulo;
        else $this->titulo = $SITE_TITLE;// </editor-fold>
    }

    /**
     * Insere header HTML
     */
    function irPara($url){
        header("Location: $url");
    }
    function iniciarSite() {
        // <editor-fold defaultstate="collapsed" desc="Insere a tag head e inicia a exibição do site">
        ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pt-br">
<head>
    <meta name="author" content="Hellynson Cassio Lana;Tiago Donizetti Gomes" />
    <meta lang="pt-br" name="description" content="Quadrinhos para todos os tipos de humor" />
    <meta name="keywords" content="quadrinhos, esdr&uacute;xulos, humor, entretenimento, tiras"  />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="/layout/screen.css" />
    <link rel="stylesheet" type="text/css" media="print" href="/layout/print.css" />
    <link rel="stylesheet" type="text/css" media="handheld" href="/layout/handheld.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/layout/default.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/layout/hell.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/layout/tiago.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/layout/quadrinho.css" />
    <link rel="stylesheet" type="text/css" href="/js/cycle.css" />
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery.easing.1.1.1.js"></script>
    <script type="text/javascript" src="/js/chili-1.7.pack.js"></script>
    <script type="text/javascript" src="/js/jquery.cycle.all.latest.js"></script>
    <title>
                <?php echo $this->titulo; ?></title>
</head>
<body>
        <?php
        // </editor-fold>

    }
    function concluirSite(){
        // <editor-fold defaultstate="collapsed" desc="Fecha as tags e termina a exibição do site">
    ?>
</body>
</html>
        <?php
        // </editor-fold>

    }


    /**
     * Lista histórias para o usuário
     */
    function listarHistoria() {
        if ($this->objetoDeNavegacao instanceof Historia) {
            if (strtolower($this->objetoDeNavegacao->getFormato()->getNome())=='quadrinho') {

            }
            else throw new Exception ('Chamada de funcão inválida para este momento. ');
        }
    }
    /**
     * Exibe uma história para o usuário
     * @param Historia $historia
     */
    function exibirHistoria() {
        if ($this->objetoDeNavegacao instanceof Historia) {
            if (strtolower($this->objetoDeNavegacao->getFormato()->getNome())=='quadrinho') {

            }
        }
    }
    /**
     * Lista comentários da história
     *
     */
    function listarComentarios() {
        if ($this->objetoDeNavegacao instanceof Historia) {

        }
    }
    /**
     * Exibe formulário para postar comentário
     */
    function exibirFormularioComentario() {
        if ($this->objetoDeNavegacao instanceof Historia) {
            if (strtolower($this->objetoDeNavegacao->getFormato()->getNome())=='quadrinho') {

            }
        }
    }
    /**
     * Exibe a lista de tiras
     */

    function exibirListaTiras() {
        if ($this->objetoDeNavegacao instanceof Historia) {
            if (strtolower($this->objetoDeNavegacao->getFormato()->getNome())=='tira') {

            }
        }
    }

    /**
     * Exibe uma tira
     * @param Historia $tira
     */

    function exibirTira() {
        if ($this->objetoDeNavegacao instanceof Historia) {
            if (strtolower($this->objetoDeNavegacao->getFormato()->getNome())=='tira') {

            }
        }
    }

    function listarPersonagem () {
        if ($this->objetoDeNavegacao instanceof Personagem) {

        }
    }
    function exibirPersonagem () {
        if ($this->objetoDeNavegacao instanceof Personagem) {

        }
    }

    function fazerCadastro() {
        if ($this->objetoDeNavegacao instanceof Usuario) {

        }
    }
    function fazerLogin() {
        if ($this->objetoDeNavegacao instanceof Usuario) {

        }
    }

    function faleConosco() {
        if ($this->objetoDeNavegacao instanceof Usuario) {

        }
    }
    function exibirPropagandaTopo() {

    }

    function exibirPropagandaLateral() {

    }




}

?>
