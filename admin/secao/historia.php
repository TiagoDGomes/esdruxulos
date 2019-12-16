<?php
include_once "system.php";

switch ($_GET['acao']) {
    case "editar":
    case "criar":

    // <editor-fold defaultstate="collapsed" desc="Formulario de criação/edição de história">
        ?>
<h2>Hist&oacute;ria</h2>
<form action="?secao=historia&acao=executar" method="post" enctype="multipart/form-data">
    <table id="tabela" border="0">
                <?php
                if ($_POST['id']!="") {

                    ?>
        <tr>
            <td>ID:</td>
            <td><?php echo $_POST['id'];
                            echo HTML::createHiddenInput("id", $_POST['id']); ?></td>
        </tr>
                    <?php
                }
                ?>

        <tr>
            <td>Nome da hist&oacute;ria:</td>
            <td><?php echo HTML::createInputTextBox("titulo", "titulo",35,50,$_POST['titulo']); ?></td>
        </tr>
        <tr>
            <td>Tipo de história:</td>
            <td><?php
                        /*     try {
                            Listagem::exibirListaFormatosOption($_POST['formato']);
                        } catch (Exception $exc) {
                            new Mensagem($exc->getMessage(),"b","info");
                            $submitDisabled=TRUE;
                        }
                    *
                        */
                        if ($_POST['formato']=="")$qq='checked="checked"'; else $tt = 'checked="checked"';
                        //echo HTML::createRadioOption("formato-1", "Quadrinho", "formato",1,$qq);
                        // echo HTML::createRadioOption("formato-2", "Tira", "formato",2,$tt);
                        ?>

                <input onclick="verp(1)" id="formato-1" type="radio" name="formato" <?php echo $qq ?> value="1"><label for="formato-1">Quadrinho</label><br>
                <input onclick="verp(2)" id="formato-2" type="radio" name="formato" <?php echo $tt ?> value="2"><label for="formato-2">Tira</label>

            </td>
        </tr>

        <tr>
            <td>Descri&ccedil;&atilde;o:</td>
            <td><?php echo HTML::createTextArea("descricao", "descricao",5,40,$_POST['descricao']); ?></td>
        </tr>
        <tr>
            <td>Tipo de humor:</td>
            <td style="border:1px dotted black"><?php
                        try {
                            Listagem::exibirListaHumorCheckBox();
                        } catch (Exception $exc) {
                            new Mensagem($exc->getMessage(),"b","info");
                            $submitDisabled=TRUE;
                        }
                        ?></td>
        </tr>
        <tr>
            <td>Personagens:</td>
            <td style="border:1px dotted black"><?php
                        try {
                            Listagem::exibirListaPersonagensCheckBox();
                        }
                        catch (Exception $exc) {
                            new Mensagem(HTML::createImgTag("/admin/img/Ball-info-16.png", "info").$exc->getMessage().' '.HTML::createLink("?secao=personagem&acao=criar", "Cadastrar um novo personagem"),"b");
                            $submitDisabled=TRUE;
                        }
                        ?>
            </td>
        </tr>
        <tr>
            <td>P&aacute;ginas:</td>
           <!---  <td>
               <div class="MultiFile-wrap" id="pagina">
                    <input id="pagina" name="pagina" maxlength="99" class="multi" type="file" />
                    <div class="MultiFile-list" id="pagina_wrap_list">

                    </div>
                </div>
            </td>
           -->
            <td id="listaPagina" style="border:1px dotted black">
                <div id="lpags"><?php Listagem::exibirListaAddPaginas(); ?></div>
                <div id="lpag" style="display: none"><input type="file" name="paginaTira" /></div>
                <script type="text/javascript">
                    function verp(p){
                        document.getElementById('lpags').style.display='none';
                        document.getElementById('lpag').style.display='none';
                        if (p==1){
                            document.getElementById('lpags').style.display='block';
                        }else{
                            document.getElementById('lpag').style.display='block';
                        }

                    }
        <?php
        if ($qq=="") {
            echo 'verp(2);';
        }
        ?>
                </script>
            </td>
        </tr>


        <tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo HTML::createSubmitButton("enviar", "Salvar",$submitDisabled); ?></td>
        </tr>
        </tr>
    </table>
</form>


        <?php
//////////////////////////////////////////////////////
//  </editor-fold>
        break;
    case "alterar":
    // <editor-fold defaultstate="collapsed" desc="Listar histórias">
        echo "<h2>Histórias</h2>";
        $f = new Formato();
        $f->carregarPorValorAtributo("nome", "quadrinho");
        Listagem::exibirListaHistoriasParaEdicao($f);
        $f = new Formato();
        $f->carregarPorValorAtributo("nome", "tira");
        Listagem::exibirListaHistoriasParaEdicao($f);// </editor-fold>
        break;
    case "executar":
    // <editor-fold defaultstate="collapsed" desc="Tratar o que o adminstrador enviou pelo método POST">

        $mensagemCriacao = Criacao::HistoriaPorPostMethod();
        if ($mensagemCriacao=="ok") {
            new Mensagem("Sua história foi salva", "h2","ok");
        }
        else {
            new Mensagem("Erro ao criar história", "h2","error");
            new Mensagem($mensagemCriacao, "p");
            new Mensagem("Clique <a href=\"javascript:history.go(-1)\">aqui</a> para voltar","p");
        }


        //// </editor-fold>
        break;
    case "excluir":
        $h = new Historia();
        try {
            $h->carregarPorID($_POST['id']);
            $h->excluir();
            new Mensagem("Sua história foi excluída", "h2","ok");
        } catch (Exception $exc) {
            new Mensagem("Erro ao excluir história", "h2","error");
        }

        break;
    default:
        ?>
        <ul>
                <li class="novo"><a href="?secao=historia&acao=criar">Criar uma nova história</a></li>
                <li class="edit"><a href="?secao=historia&acao=alterar">Alterar/excluir uma história</a></li>
        </ul>
        <?php
}

?>
