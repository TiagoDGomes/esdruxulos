<?php

class Personagem extends ItemSite implements ItemContagem {
    public $historia_list;

    public static function getListID($addParam = "" ) {
        $query = "SELECT id FROM ".get_class()." ". $addParam;
        return bd::executeSqlParaArraySimples($query);

    }
    public function countHistoria() {
        return count($this->historia_list);
    }
    public function getNome() {
        return $this->ATRIBUTO['nome'];
    }
    public function setNome($nome){
        $this->ATRIBUTO['nome']=$nome;
    }
    public function getDescricao() {
        return $this->ATRIBUTO['descricao'];
    }
    public function setDescricao($descricao){
        $this->ATRIBUTO['descricao']=$descricao;
    }
    public function getImagem() {
        return $this->ATRIBUTO['imagem'];
    }
    public function setImagem($imagem){
        $this->ATRIBUTO['imagem']=$imagem;
    }
    public function getHistoria($index) {
        $h = new Historia();
        $h->carregarPorID($this->historia_list[$index]);
        return $h;
    }
    public static function count() {
        return parent::countTotal(new Personagem());
    }
//
    protected function carregarRelacionamentos() {
        $this->historia_list = $this->carregarListaManyToMany(new Historia(), "HistoriaPersonagem","");
    }
    protected function salvarRelacionamentos() {
        $this->salvarListaManyToMany(new Historia(),"HistoriaPersonagem",$this->historia_list);
    }
    public function excluir (){
        $this->excluirRelacionamentos('HistoriaPersonagem');
        parent::excluir();
    }
    public function mostrarPersonagemParaUsuario(){
        // <editor-fold defaultstate="collapsed" desc="Exibir personagem">
        ?>
                <div id="personagens" class="conteudoMeio">
                    <fieldset class="personagemVisualizacao">
                        <legend><?php echo $this->getNome(); ?></legend>
                        <span class="imagemPersonagem"><img src="/personagem/img/<?php echo $this->getID(); ?>" alt="<?php echo $this->getNome(); ?>" /></span>
                        <div>
                            <?php echo $this->getDescricao(); ?><br />
                            <p><strong>Histórias que participa:</strong></p>
                            <ul>
                               <?php
                               for ($i=0;$i<$this->countHistoria();$i++) {
                                      ?>
                                <li><?php
                                          echo HTML::createLink($this->getHistoria($i)->getURLHistoria(), $this->getHistoria($i)->getTitulo());
                                      ?>
                                </li>
                                          <?php
                                }
                                ?>
                            </ul>

                        </div>
                    </fieldset>
                </div>
                                    <?php
                                    // </editor-fold>
    }
    public static function mostrarListaPersonagensParaUsuario() {
        // <editor-fold defaultstate="collapsed" desc="Exibe lista de personagens">
        $ids = Personagem::getListID();
        if (count($ids)>0) {
            ?>
<h2>Personagens</h2>
<table id="listaDePersonagens" cellspacing="0" cellpadding="10">
    <tr style="width: 15px;">
                    <?php
                    foreach($ids as $i) {
                        $p = new Personagem();
                        $p->carregarPorID($i);
                        echo '<td style="width: 190px; height:280px; text-align:center">'.
                                HTML::createLink("/personagem/$i.html", '<img width="180" height="230" src="/personagem/img/'.$i.'"><br>'.
                                $p->getNome()).
                                '</td>';
                        if ($x == 2) {
                            echo "</tr>\n<tr>";
                            $x=-1;
                        }
                        $x++;
                    }

                    ?>
    </tr>
</table>
            <?php
        }
        else {
            new Mensagem("Nenhum personagem foi criado. O site está em construção.", "p");
        }
// </editor-fold>
    }
    public function getURLPersonagem(){
        return "/personagem/" . $this->getID() . ".html";
    }
    public function mostrarPersonagemComoResultadoDeBusca($stringDestaque="") {
        // <editor-fold defaultstate="collapsed" desc="HTML de exibição de personagem para resultado de busca">
        ?>

<div class="resultadoItem">
    <span class="miniatura"><img src="/personagem/img/<?php  echo $this->getID() ?>" alt="" /></span>
    <span class="link">
        <a href="<?php echo $this->getURLPersonagem(); ?>">
            <?php echo str_replace($stringDestaque, "<strong>$stringDestaque</strong>",  $this->getNome()); ?>
        </a>
    </span><br />
    <span class="descricao">
            <?php echo str_replace($stringDestaque, "<strong>$stringDestaque</strong>",  $this->getDescricao()) ?>
    </span><br />
    <span class="caminho">
        http://<?php echo $_SERVER["SERVER_NAME"] ?> ››  <?php  echo HTML::createLink("/personagem/index.html/","Personagem") ?>
    </span>
</div>
        <?php
        // </editor-fold>

    }

}
?>
