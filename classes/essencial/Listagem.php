<?php
/*
 * Classe Listagem
 *
 *
*/
class Listagem {

    /**
     * Exibe a pontuação em estrelas baseando-se na nota obtida
     * @param String $nomeNota
     * @param String $nota
     */
    static function exibirNotasEstrelasFixas($nomeNota,$nota) {
        echo self::getNotasEstrelasFixas($nomeNota, $nota);
    }
    /**
     * <p>Exibe estrelas para serem utilizadas como método de votação</p>
     * @author Tiago
     * <p>O usuário ao clicar numa estrela, uma tag HIDDEN define o valor da nota que ele escolheu</p>
     */
    static function getNotasEstrelasFixas($nomeNota,$nota){
                // <editor-fold defaultstate="collapsed" desc="Código que exibe as estrelas">

        for ($i=1;$i<=5;$i++) {
            if ($i<=$nota)
                $cor[$i]='red';
            else
                $cor[$i]='white';

        }
        $star = '<span>
<span class="estrelaNota" style="background-image: url(/img/star_'. $cor[1] .'.gif)"><img alt="1" height="15" width="15" src="/img/b.gif" /></span>
<span class="estrelaNota" style="background-image: url(/img/star_'. $cor[2] .'.gif)"><img alt="2" height="15" width="15" src="/img/b.gif" /></span>
<span class="estrelaNota" style="background-image: url(/img/star_'. $cor[3] .'.gif)"><img alt="3" height="15" width="15" src="/img/b.gif" /></span>
<span class="estrelaNota" style="background-image: url(/img/star_'. $cor[4] .'.gif)"><img alt="4" height="15" width="15" src="/img/b.gif" /></span>
<span class="estrelaNota" style="background-image: url(/img/star_'. $cor[5] .'.gif)"><img alt="5" height="15" width="15" src="/img/b.gif" /></span>
</span>';
        return $star;
        // </editor-fold>
    }
    static function exibirNotasEstrelasVoto() {
        // <editor-fold defaultstate="collapsed" desc="Código que exibe estrelas para voto">
        ?>
<script type="text/javascript">
    function vote(id){
        for (i=1;i<=id;i++){
            document.getElementById('nt'+i).style.backgroundImage='url(/img/star_red.gif)'
        }
        for (i=id+1;i<=5;i++){
            document.getElementById('nt'+i).style.backgroundImage='url(/img/star_white.gif)'
        }
        document.getElementById('notaValor').innerHTML=id;
        document.getElementById('valorNotaPost').value=id;
    }
</script>
<span id="nt1" style="background-image: url(/img/star_white.gif)"><a href="javascript:void(0);" onclick="vote(1)"><img alt="1" height="15" width="15" src="/img/b.gif" /></a></span>
<span id="nt2" style="background-image: url(/img/star_white.gif)"><a href="javascript:void(0);" onclick="vote(2)"><img alt="2" height="15" width="15" src="/img/b.gif" /></a></span>
<span id="nt3" style="background-image: url(/img/star_white.gif)"><a href="javascript:void(0);" onclick="vote(3)"><img alt="3" height="15" width="15" src="/img/b.gif" /></a></span>
<span id="nt4" style="background-image: url(/img/star_white.gif)"><a href="javascript:void(0);" onclick="vote(4)"><img alt="4" height="15" width="15" src="/img/b.gif" /></a></span>
<span id="nt5" style="background-image: url(/img/star_white.gif)"><a href="javascript:void(0);" onclick="vote(5)"><img alt="5" height="15" width="15" src="/img/b.gif" /></a></span>
<span id="notaValor"></span>
<input type="hidden" id="valorNotaPost" name="valorNotaPost" value="1" />
        <?php
        //// </editor-fold>
    }
    /**
     * Exibe a lista de anunciantes numa caixa SELECT
     */
    static function exibirListaAnunciantesSelect() {
        // <editor-fold defaultstate="collapsed" desc="Código que exibe os anunciantes">
        if (Anunciante::count()!=0) {
            HTML::startSelect("idAnunciante");
            $ids = Anunciante::getListID();
            foreach($ids as $i) {
                $a = new Anunciante();
                $a->carregarPorID($i);
                HTML::selectInsertNewOption($i,$a->getRazaoSocial());
            }
            HTML::closeSelect();
        }
        else {
            throw new Exception("Nenhum anunciante cadastrado.");
        }// </editor-fold>

    }
    static function exibirListaEstadosSelect($defaultValue=null) {
        // <editor-fold defaultstate="collapsed" desc="Código que exibe os anunciantes">
        if ($defaultValue!=null) $df = $defaultValue;
        if (Estado::count()>0) {
            HTML::startSelect("idEstado");
            $ids = Estado::getListID();
            foreach($ids as $i) {
                $e = new Estado();
                $e->carregarPorID($i);
                if ($e->getNome()!="Desconhecido"){
                    if ($df==$e->getID()){
                        $f=true;
                    }
                    else {
                        $f=false;
                    }
                    HTML::selectInsertNewOption($i,$e->getNome(),$f);
                }
            }
            HTML::closeSelect();
        }
        else {
            throw new Exception("Nenhum estado cadastrado.");
        }// </editor-fold>

    }

    /**
     * Exibe uma lista de formatos de histórias disponíveis
     * @param int $default_value O ID de um formato que será definido como valor padrão
     */
    static function exibirListaFormatosOption($default_value="0") {
        // <editor-fold defaultstate="collapsed" desc="Código que exibe a lista de formatos">
        if (Formato::count()!=0) {
            $ids = Formato::getListID();
            foreach ($ids as $i) {
                $f = new Formato();
                $f->carregarPorID($i);
                $c=0;
                if ($default_value==$i)$c=1;
                echo HTML::createRadioOption("formato-$i", $f->getNome(), "formato",$i,$c);
            }

        }
        else {
            throw new Exception("Nenhum formato cadastrado.");
        }
        // </editor-fold>
    }

    /**
     * Exibe uma lista de humor em caixas de seleção CHECKBOX
     */
    static function exibirListaHumorCheckBox() {
        // <editor-fold defaultstate="collapsed" desc="Código que exibe a lista de humor">
        if (Humor::count()!=0) {
            $ids = Humor::getListID();
            foreach ($ids as $i) {
                $h = new Humor();
                $h->carregarPorID($i);
                echo HTML::createCheckBox("humor-$i", "humor[$i]", $h->getNome());
            }
        }
        else {
            throw new Exception("Nenhum tipo de humor cadastrado.");
        }// </editor-fold>

    }
    /**
     * Exibe uma lista de personagens em caixas de seleção CHECKBOX
     */
    static function exibirListaPersonagensCheckBox() {
        // <editor-fold defaultstate="collapsed" desc="Código que exibe a lista de personagens">
        if (Personagem::count()!=0) {
            $ids= Personagem::getListID();
            foreach ($ids as $i) {
                $p = new Personagem();
                $p->carregarPorID($i);
                echo HTML::createCheckBox("personagem-$i", "personagem[$i]", $p->getNome());
            }
        }
        else {
            throw new Exception("Nenhum personagem cadastrado.");
        }
        // </editor-fold>

    }
    /**
     * Exibe um sistema que fornece opção de adicionar páginas para uma história
     */
    static function exibirListaAddPaginas() {
        // <editor-fold defaultstate="collapsed" desc="codigo para inserir paginas">

        ?>
<script type="text/javascript">
    function addImagens(){
        var lista = document.getElementById("listaPagina");
        var definirQtd = document.getElementById("definirQtdade");
        var i;
        var qtPags = document.getElementById("qtPags").value;
        definirQtd.innerHTML = "";
        lista.innerHTML +=  '<span id="item-0"><input name="pagina[0]" type="file" accept="image/*" /> capa (miniatura)<br /></span>';
        lista.innerHTML +=  '<span id="item-1"><input name="pagina[1]" type="file" accept="image/*" /> (1) capa <br /></span>';

        for (i = 2; i-2<qtPags; i++){
            lista.innerHTML +=  '<span id="item-'+i+'"><input name="pagina['+i+']" type="file" accept="image/*" /> ('+(i-1)+') página <br /></span>';
        }
    }
</script>
<span id="definirQtdade">Quantidade de páginas: <input name="qtPags" value="1" type="text" maxlength="2" size="1" id="qtPags" />
    <input value="adicionar" type="button" onclick="addImagens()"></span>
        <?php
// </editor-fold>
    }
    /**
     * Exibe uma lista de histórias para edição
     * @global String $SITE_REL_PAGINAS
     * @param Formato $object_formato Qualquer objeto Formato que possui um formato de história definido
     *
     */
    public static function exibirListaHistoriasParaEdicao($object_formato) {
        // <editor-fold defaultstate="collapsed" desc="Código que exibe a lista de histórias para edição">
        global $SITE_REL_PAGINAS;
        $ids = Historia::getListIDPorFormato($object_formato);
        HTML::startFieldSet($object_formato->getNome());
        if (count($ids)!=0) {
            $ids=array_reverse($ids);
            echo '<table>';
            foreach($ids as $i) {
                echo '<tr>';
                $h = new Historia();
                $h->carregarPorID($i);
                echo '<td>'.html::createLink($h->getURLHistoria(), $h->getTitulo(),"greybox").'</td>';
                HTML::startForm("?secao=historia&acao=editar", "POST");
                echo '<td>'.HTML::createHiddenInput("id", $i);
                echo HTML::createHiddenInput("titulo", $h->getTitulo());
                echo HTML::createHiddenInput("formato", $h->getFormato()->getID());
                echo HTML::createHiddenInput("descricao", $h->getDescricao());
                echo HTML::createSubmitButton("Editar","Editar");
                HTML::closeForm();
                echo '</td><td>';
                HTML::startForm("?secao=historia&acao=excluir", "POST","","if (!confirm('Você tem certeza em remover ".$h->getTitulo()."?')){return false;};");
                echo HTML::createHiddenInput("id", $i);
                echo HTML::createSubmitButton("Excluir","Excluir").'</td>';
                HTML::closeForm();
                echo "</tr>\n";
            }
            echo "</table>\n";
        }
        HTML::closeFieldSet();
       // </editor-fold>

    }
}

?>
