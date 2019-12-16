<?php

class Historia extends ItemSite implements ItemContagem {

    private $personagem_list;

    private $pagina_list;

    private $comentario_list;

    private $humor_list;

    public function getMediaDeNotas() {
        $query = "SELECT avg(nota) FROM comentario WHERE idHistoria=". $this->getID();
        $n= bd::executeSqlParaArraySimples($query);
        return $n[0];
    }
    /**
     *
     * @return Array
     */

    public static function getListID($addParam = "" ) {
        $query = "SELECT id FROM ".get_class()." ". $addParam;
        return bd::executeSqlParaArraySimples($query);

    }
    protected function setID($id) {
        $this->id=$id;
    }
    public function countPersonagem() {
        return count($this->personagem_list);
    }
    public function countComentario() {
        return count($this->comentario_list);
    }
    public function countPagina() {
        return count($this->pagina_list);
    }
    public function countHumor() {
        return count($this->humor_list);
    }
    public function getTitulo() {
        return $this->ATRIBUTO['titulo'];
    }
    public function setTitulo($titulo) {
        $this->ATRIBUTO['titulo'] = $titulo;
    }
    public function getDescricao() {
        return $this->ATRIBUTO['descricao'];
    }
    public function setDescricao($descricao) {
        $this->ATRIBUTO["descricao"]= $descricao;
    }
    public function getDataInsercao() {
        return $this->ATRIBUTO['dataInsercao'];
    }
    public function setDataInsercao($dataInsercao) {
        $this->ATRIBUTO["dataInsercao"]= $dataInsercao;
    }

    public function getPersonagem($index) {
        $p = new Personagem();
        $p->carregarPorID($this->personagem_list[$index]);
        return $p;
    }
    public function setPersonagem($index,$object_personagem) {
        $this->personagem_list[$index] = $object_personagem->id;
    }

    public function getPagina($index) {
        $p = new Pagina();
        $p->carregarPorID($this->pagina_list[$index]);
        return $p;
    }
    public function setPagina($index,$object_pagina) {
        $this->pagina_list[$index]= $object_pagina->id;
    }
    public function getComentario($index) {
        $c = new Comentario();
        $c->carregarPorID($this->comentario_list[$index]);
        return $c;

    }
    /**
     *
     * @param Integer $index
     * @param Comentario $object_comentario
     */
    public function setComentario($index,$object_comentario) {
        $this->comentario_list[$index] = $object_comentario->id;
    }
    //@ManyToOne
    public function getFormato() {
        $f = new Formato();
        $f->carregarPorID($this->ATRIBUTO['idFormato']);
        return $f;
    }

    public function setFormato($object_formato) {
        $this->ATRIBUTO['idFormato']= $object_formato->id;
    }
    public function getHumor($index) {
        $h = new Humor();
        $h->carregarPorID($this->humor_list[$index]);
        return $h;
    }
    public function setHumor($index,$object_humor) {
        //$this->humor = $humor;
        $this->humor_list[$index]=$object_humor->id;
    }
    public static function count() {
        return parent::countTotal(new Historia());
    }
    public static function pesquisar($string) {
        // Pesquisar em histórias:
        $query = "SELECT * FROM Historia
                    WHERE titulo LIKE \"%$string%\" OR
                            descricao LIKE \"%$string%\"";
        $result = bd::executeSqlParaArrayTitulada($query);
        $i=0;
        foreach ($result as $r) {
            $historia_object_list[$i] = new Historia();
            $historia_object_list[$i]->carregarPorID($r['id']);
            $i++;

        }
        return $historia_object_list;

    }
    public function salvar() {
        if (($this->ATRIBUTO['idFormato'])!=null) {
            if ($this->getDataInsercao()=="")$this->setDataInsercao(bd::now());
            parent::salvar();
            $this->excluirRelacionamentos("Pagina");
            parent::salvar();
        }else {
            throw new Exception("Erro para salvar. Formato não setado.");
        }
    }
    public function excluir() {
        $this->excluirRelacionamentos("HistoriaHumor");
        $this->excluirRelacionamentos("HistoriaPersonagem");
        $this->excluirRelacionamentos("Pagina");
        parent::excluir();
    }

    /**
     *
     * @param Formato $object_formato
     * @return Array
     */
    public static function getListIDPorFormato($object_formato) {
        $id = $object_formato->id;
        $query = "SELECT Historia.id as id FROM HISTORIA,FORMATO WHERE idFormato=Formato.id AND idFormato=$id ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);

    }

    protected function carregarRelacionamentos() {
        $this->personagem_list = $this->carregarListaManyToMany(new Personagem(), "HistoriaPersonagem","");
        $this->pagina_list = $this->carregarListaOneToMany(new Pagina(),"ORDER BY indice ASC");
        $this->comentario_list = $this->carregarListaOneToMany(new Comentario(), "ORDER by dataPost ASC");
        $this->humor_list = $this->carregarListaManyToMany(new Humor(), "HistoriaHumor", "");
    }
    protected function salvarRelacionamentos() {

        $this->salvarListaManyToMany(new Humor(),"HistoriaHumor",$this->humor_list);
        $this->salvarListaManyToMany(new Personagem(),"HistoriaPersonagem",$this->personagem_list);
    }
    public function mostrarHistoriaParaUsuario() {
        // <editor-fold defaultstate="collapsed" desc="HTML de exibição de história em quadrinho">
        if ($this->getFormato()->getNome()=="Quadrinho") {
            ?>
<script type="text/javascript">

    $('#sshistoria img').hide();
    $('#sshistoria img:first').show();
    $('#sshistoria').cycle({
        fx: 'shuffle',
        next: '.proximo',
        prev: '.anterior',
        timeout:  0,
        autostop: 1
    });


</script>
<div id="historia">
    <h2><?php echo $this->getTitulo(); ?></h2>
    <p class="dNavegacao">
        <a class="anterior" href="javascript:void();"><img alt="" src="/img/anterior.png"></a>
        <a class="proximo" href="javascript:void();"><img alt="" src="/img/proximo.png"></a>
    </p>
    <div id="sshistoria" class="pics">
                    <?php
                    if ($this->getFormato()->getNome_lcase()=="quadrinho") {
                        for($i=1;$i<$this->countPagina();$i++) {
                            echo "\n".'<img class="pagina" src="/pagina/'.
                                    $this->getFormato()->getNome_lcase().'/'.
                                    $this->getID().'/'.$i.'"'.
                                    ' alt="'.$this->getTitulo().' - página '.$i.'" />'
                            ;
                        }

                    }
                    ?>
        <div class="pagina">
            <h3>Comentários:</h3>
                        <?php
                        if ($this->countComentario()>0) {
                            // <editor-fold defaultstate="collapsed" desc="Exibe todos os comentários">
                            for($i=0;$i<$this->countComentario();$i++) {
                                // <editor-fold defaultstate="collapsed" desc="Exibe o comentário">
                                HTML::startFieldSet($this->getComentario($i)->getUsuario()->getNome() .' em '. date("d/m/Y h:i", strtotime($this->getComentario($i)->getDataPost())));

                                if ($this->getComentario($i)->getConteudo()=='') {
                                    echo '<p class="semMaisInformacoes">O usuário não postou comentário</p>';
                                }else
                                    echo '<p>'.$this->getComentario($i)->getConteudo().'</p>';

                                Listagem::exibirNotasEstrelasFixas($this->getTitulo(), $this->getComentario($i)->getNota());
                                HTML::closeFieldSet();// </editor-fold>
                                // <editor-fold defaultstate="collapsed" desc="Se houver mais de 6 comentários numa única página, uma nova página é criada.">
                                if ((($i+1) % 6) == 0) {
                                    echo '
                                   <p class="dNavegacao">
                                         <a class="anterior" href="javascript:void();"><img src="/img/anterior.png"></a>
                                          <a class="proximo" href="javascript:void();"><img src="/img/proximo.png"></a>
                                   </p>
                                   </div><div class="pagina"><h3>Comentários (página '.round(($i+1) / 7 +1).')</h3>'   ;
                                }// </editor-fold>
                            }

                        } // </editor-fold>
                        else {
                            // <editor-fold defaultstate="collapsed" desc="Exibe a mensagem que não há comentários">
                            ?><p class="semMaisInformacoes">Nenhum comentário.</p><?php
                            // </editor-fold>
                        }
                        Exibicao::exibirFormularioComentario($this);
                        ?>

        </div>
    </div>
    <p class="dNavegacao">
        <a class="anterior" href="javascript:void();">&lt; anterior</a>
        <a class="proximo" href="javascript:void();">pr&oacute;ximo &gt;</a>
    </p>
</div>
            <?php

        }
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="HTML de exibição de tirinha">
        if ($this->getFormato()->getNome()=="Tira") {
            ?>
<div id="historia">
    <h2><?php echo $this->getTitulo(); ?></h2>
    <div class="centralizado">
        <img src="/img/historia/<?php echo $this->getPagina(0)->getCaminho() ?>" alt="" />
    </div>
    <div class="pagina">
        <h3>Comentários:</h3>
                    <?php
                    if ($this->countComentario()>0) {
                        // <editor-fold defaultstate="collapsed" desc="Exibe todos os comentários">
                        for($i=0;$i<$this->countComentario();$i++) {
                            // <editor-fold defaultstate="collapsed" desc="Exibe o comentário">
                            HTML::startFieldSet($this->getComentario($i)->getUsuario()->getNome() .' em '. date("d/m/Y h:i", strtotime($this->getComentario($i)->getDataPost())));

                            if ($this->getComentario($i)->getConteudo()=='') {
                                echo '<p class="semMaisInformacoes">O usuário não postou comentário</p>';
                            }else
                                echo '<p>'.$this->getComentario($i)->getConteudo().'</p>';

                            Listagem::exibirNotasEstrelasFixas($this->getTitulo(), $this->getComentario($i)->getNota());
                            HTML::closeFieldSet();// </editor-fold>

                        }

                    } // </editor-fold>
                    else {
                        // <editor-fold defaultstate="collapsed" desc="Exibe a mensagem que não há comentários">
                        ?><p class="semMaisInformacoes">Nenhum comentário.</p><?php
                        // </editor-fold>
                    }
                    Exibicao::exibirFormularioComentario($this);
                    ?>

    </div>
</div>


            <?php
        }
        // </editor-fold>

    }
    /**
     *
     * @global String $SITE_REL_PAGINAS
     * @param Formato $formato
     */
    public static function mostrarListaHistoriasParaUsuario($formato) {

        $ids = Historia::getListIDPorFormato($formato);
        ?>
<div class="conteudoMeio">
    <h2><?php echo $formato->getNome()?>s</h2><?php
            // <editor-fold defaultstate="collapsed" desc="Exibe lista de histórias em quadrinhos">
            if ($formato->getNome()=="Quadrinho") {
                if (count($ids)!=0) {
                    $ids=array_reverse($ids);
                    foreach($ids as $i) {
                        global $SITE_REL_PAGINAS;
                        $h = new Historia();
                        $h->carregarPorID($i);
                        HTML::startFieldSet($h->getTitulo(), "", "itemListaQuadrinho", "");
                        $img = HTML::createImgTag("/pagina/".
                                $formato->getNome_lcase()."/".
                                $h->getID()."/0", "","","imagemMiniatura");
                        echo HTML::createLink($h->getURLHistoria(), $img);
                        echo "<div>".nl2br($h->getDescricao()).
                                "<br /><br /><b>Lançado em: </b>".date("d/m/Y",strtotime($h->getDataInsercao())).
                                "<br /><b>Quantidade de páginas: </b>".($h->countPagina()-1).
                                "<br />
                                    ".Listagem::getNotasEstrelasFixas($h->getTitulo(), $h->getMediaDeNotas()).

                                "</div>";
                        HTML::closeFieldSet();
                    }
                }
                else new Mensagem("Nenhuma história foi criada. O site está em construção.","p");

            }
            // </editor-fold>

            // <editor-fold defaultstate="collapsed" desc="Exibe lista de tirinhas">
            if ($formato->getNome()=="Tira") {
                ?><dl><?php
                    if (count($ids)!=0) {
                        $ids=array_reverse($ids);
                        foreach($ids as $i) {
                            $h = new Historia();
                            $h->carregarPorID($i);
                            ?>
        <p>
                                <dt><?php echo HTML::createLink($h->getURLHistoria(), $h->getTitulo()); ?></dt>
                                <dd><?php echo $h->getDescricao(); ?></dd>
        </p>
                            <?php
                        }
                    }
                    ?></dl><?php
            }
            // </editor-fold>
            ?>
</div>
        <?php
    }
    public function mostrarHistoriaComoResultadoDeBusca($stringDestaque="") {
        // <editor-fold defaultstate="collapsed" desc="HTML de exibição de história para resultado de busca">
        ?>

<div class="resultadoItem">
    <span class="miniatura"><img src="/pagina/<?php  echo $this->getFormato()->getNome_lcase() . "/". $this->getID() ?>/0" alt="" /></span>
    <span class="link"><a href="<?php  echo $this->getURLHistoria() ?>"><?php echo str_replace($stringDestaque, "<strong>$stringDestaque</strong>",  $this->getTitulo()); ?></a></span>
    <span class="estrelas"><?php Listagem::exibirNotasEstrelasFixas($this->getTitulo(), $this->getMediaDeNotas()) ?></span>
    <br />
    <span class="descricao"><?php echo str_replace($stringDestaque, "<strong>$stringDestaque</strong>",  $this->getDescricao()) ?></span><br />
    <span class="caminho">http://<?php echo $_SERVER["SERVER_NAME"] ?> ››  <?php  echo HTML::createLink("/historia/".$this->getFormato()->getNome_lcase()."/index.html",  $this->getFormato()->getNome()) ?></span>
</div>
        <?php
        // </editor-fold>

    }
    public function getURLHistoria() {
        return "/historia/".$this->getFormato()->getNome_lcase()."/". $this->getID() . ".html";
    }
    public function clearLists() {
        $this->personagem_list = array();
        $this->pagina_list = array();
        $this->humor_list = array();
    }

}

?>
