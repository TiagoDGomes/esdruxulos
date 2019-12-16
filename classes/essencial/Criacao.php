<?php

/**
 * <b>Classe Criacao</b>
 *
 *
 */
class Criacao {
    /**
     * Trata a criação de comentário pelo método POST
     * @global Usuario $USUARIO
     */
    static function ComentarioPorPostMethod() {
        global $USUARIO;
        $comentario = htmlspecialchars($_POST['comentario']);
        $c= new Comentario();
        $c->setUsuario($USUARIO);
        $h = new Historia();
        $h->carregarPorID($_POST['historia']);
        $c->setHistoria($h);
        $c->setConteudo($comentario);
        $c->setNota($_POST['valorNotaPost']);
        $c->salvar();
        return "ok";
        
    }
    /**
     * Trata a criação de propaganda pelo método POST
     * @global Usuario $USUARIO
     */
    static function PropagandaPorPostMethod() {
        if ($_POST['titulo']=="") return "Titulo da propaganda não definido.";
        if ($_POST['conteudo']=="") return "Descrição da propaganda não definido.";
        if (count($_POST['humor'])==0) return "Nenhum humor definido.";
        
        $p = new Propaganda();
        if ($_POST['id']!="")$p->carregarPorID($_POST['id']);
        $p->setNome($_POST['titulo']);
        $p->setConteudo($_POST['conteudo']);
        $a = new Anunciante();
        $a->carregarPorID($_POST['idAnunciante']);
        $p->setAnunciante($a);
        foreach(array_keys($_POST['humor']) as $lh) {
            $h = new Humor();
            $h->carregarPorID($lh);
            $p->setHumor($i, $h);
            $i++;
        }
        $p->setPreco($_POST['preco']);
        $p->salvar();
        return "ok";
    }
    /**
     * Trata a criação de anunciante pelo método POST
     * @global Usuario $USUARIO
     */
    function AnunciantePorPostMethod() {
        
        if($_POST['razaoSocial']=="") return "Razão social não definida.";
        if($_POST['email']=="") return "E-mail não definido.";
        $a = new Anunciante();
        if ($_POST['id']!="")$a->carregarPorID($_POST['id']);
        $a->setRazaoSocial($_POST['razaoSocial']);
        $a->setEmail($_POST['email']);
        $a->setWebsite($_POST['website']);
        $a->setTelefone($_POST['telefone']);
        $a->salvar();
        return "ok";
    }
    /**
     * Trata a criação de história pelo método POST
     * @global Usuario $USUARIO
     */
    function HistoriaPorPostMethod() {
        
        if ($_POST['titulo']=="") return "Título da história não definido.";
        if ($_POST['formato']=="") return "Formato da história não definido.";
        if (count($_POST['humor'])==0) return "Nenhum humor definido.";
        if (count($_POST['personagem'])==0) return "Nenhum personagem definido.";
        if ((count($_FILES['pagina']['tmp_name'])==0) && ($_FILES['paginaTira']['tmp_name']=="") ) return "Nenhuma página definida.";
        $h = new Historia();
        if ($_POST['id']!=""){
            $h->carregarPorID($_POST['id']);
            $h->clearLists();
        }
        $h->setTitulo($_POST['titulo']);
        $h->setDescricao(htmlspecialchars($_POST['descricao']));
        $f = new Formato();
        $f->carregarPorID($_POST['formato']);
        $h->setFormato($f);
        
        // Definindo humor
        $i=1;
        foreach(array_keys($_POST['humor']) as $lh) {
            $hm = new Humor();
            $hm->carregarPorID($lh);
            $h->setHumor($i, $hm);
            $i++;
        }
        // Definindo personagens
        $i=1;
        foreach(array_keys($_POST['personagem']) as $lh) {
            $p = new Personagem();
            $p->carregarPorID($lh);
            $h->setPersonagem($i, $p);
            $i++;
        }
        // Definindo páginas
        $i=1;

        global $SITE_DIR_ROOT,$SITE_REL_PAGINAS;

        if ($_FILES['paginaTira']['tmp_name']=="") {
            $pagina = new UploadFileArray('pagina');
            $h->salvar();

            for($i=0;$i<$pagina->count();$i++) {
                $filename = md5_file($pagina->getTmpName($i)).".".$pagina->getExtension($i);
                $destination = $SITE_DIR_ROOT.$SITE_REL_PAGINAS ."/". $filename;
                $p = new Pagina();
                $p->setCaminho($filename);
                $p->setIndice($i);
                $p->setHistoria($h);
                $p->setTipo($pagina->getType($i));
                $pagina->moveFile($i,$destination);
                $p->salvar();
            }
        }
        else {
            $h->salvar();
            $pagina = new UploadFile('paginaTira');
            $filename = md5_file($pagina->getTmpName()).".".$pagina->getExtension();
            $destination = $SITE_DIR_ROOT.$SITE_REL_PAGINAS ."/". $filename;
            $p = new Pagina();
            $p->setCaminho($filename);
            $p->setIndice(0);
            $p->setHistoria($h);
            $p->setTipo($pagina->getType());
            $pagina->moveFile($destination);
            $p->salvar();
        }
        return "ok";
    }
    /**
     * Trata a criação de personagem pelo método POST
     * @global Usuario $USUARIO
     */
    function PersonagemPorPostMethod() {
        if ($_POST['pNome']=="") return "O personagem precisa de um nome.";
        $img = new UploadFile('pImagem');
        if ($img->getFilename()=="") return "O personagem precisa de uma imagem.";
        global $SITE_DIR_ROOT,$SITE_REL_PERSONAGENS;
        $p = new Personagem();
        $p->setNome($_POST['pNome']);
        $p->setDescricao($_POST['pDescricao']);
        
        $filename = md5_file($img->getTmpName()).".".$img->getExtension();
        $p->setImagem($filename);
        $destination = $SITE_DIR_ROOT.$SITE_REL_PERSONAGENS ."/". $filename;
        $img->moveFile($destination);       
        $p->salvar();
        return "ok";
    }
}

?>
