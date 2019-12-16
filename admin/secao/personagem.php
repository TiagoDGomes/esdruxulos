<?php

function chamarListaPersonagens() {
// <editor-fold defaultstate="collapsed" desc="obsoleto">
?>
<!--
<h2>Personagens</h2>
<table>
    <tr>
        <td>H<br />
            <img src="../Site_imagens/personagem_h.png" />
        </td>
        <td>
            <textarea cols="30" rows="10" ></textarea><br />
            <input type="button" name="editar" value="Editar">
            <input type="button" name="excluir" value="Excluir">
        </td>
    </tr>
    <tr>
        <td>National Kid<br />
            <img src="../Site_imagens/personagem_national.png" />
        </td>
        <td>
            <textarea cols="30" rows="10" ></textarea><br />
            <input type="button" name="editar" value="Editar">

            <input type="button" name="excluir" value="Excluir">
        </td>
    </tr>

    <td>Zumb&iacute;gia<br />


        <img src="../Site_imagens/personagem_zumbigia.png" />
    </td>

    <td>
        <textarea cols="30" rows="10" ></textarea><br />
        <input type="button" name="editar" value="Editar">

        <input type="button" name="excluir" value="Excluir">
    </td>





</table>
-->
<?php
// </editor-fold>

}





switch ($_GET['acao']) {
    case 'editar':
    case "criar":
        // <editor-fold defaultstate="collapsed" desc="Criar/Editar personagem">
        ///////////////////////////
        ?>
<h2>Personagem</h2>
<form action="?secao=personagem&acao=executar" method="post" enctype="multipart/form-data">
    <table id="tabela">
        <?php
            if ($_POST['id']!=""){
        ?>
        <tr>
            <td>ID:</td>
            <td><?php echo $_POST['id']; echo HTML::createHiddenInput("id", $_POST['id']); ?></td>
        </tr>
        <?php
            }
        ?>

        <tr>
            <td>Nome do personagem:</td>

            <td><?php echo HTML::createInputTextBox("pNome", "pNome",35,50,$_POST['nome']); ?></td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td><?php echo HTML::createTextArea("pDescricao", "pDescricao",5,45,$_POST['descricao']); ?></td>
        </tr>
        <tr>
            <td>Imagem: </td>
            <td><?php echo HTML::createInputSelectFile("pImagem", "pImagem"); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo HTML::createSubmitButton("salvar", "Salvar"); ?></td>
        </tr>

    </table>
</form>

    <?php
    // </editor-fold>
        break;
    case "alterar":
        // <editor-fold defaultstate="collapsed" desc="Código que exibe a lista de personagens para edição">
        global $SITE_REL_PAGINAS;
        echo "<h2>Personagens</h2>";
        $ids = Personagem::getListID();
        HTML::startFieldSet('Personagens');
        if (count($ids)!=0) {
            $ids=array_reverse($ids);
            echo '<table>';
            foreach($ids as $i) {
                echo '<tr>';
                $p = new Personagem();
                $p->carregarPorID($i);
                HTML::startForm("?secao=personagem&acao=editar", "POST");
                echo '<td><a class="greybox" href="/personagem/'.$i.'.html">'. $p->getNome().'</a></td>';
                echo '<td>'.HTML::createHiddenInput("id", $i);
                echo HTML::createHiddenInput("nome", $p->getNome());
                echo HTML::createHiddenInput("descricao", $p->getDescricao());
                echo HTML::createSubmitButton("Editar","Editar");
                HTML::closeForm();
                echo '</td><td>';
                HTML::startForm("?secao=personagem&acao=excluir", "POST","","if (!confirm('Você tem certeza em remover ".$p->getNome()."?')){return false;};");
                echo HTML::createHiddenInput("id", $i);
                echo HTML::createSubmitButton("Excluir","Excluir").'</td>';
                HTML::closeForm();
                echo "</tr>\n";
            }
            echo "</table>\n";
        }
        HTML::closeFieldSet();
        // </editor-fold>
        break;
    case "executar":
        $mensagemCriacao = Criacao::PersonagemPorPostMethod();
        if ($mensagemCriacao=="ok") {
            new Mensagem("Seu personagem foi salvo", "h2","ok");

        }
        else {
            new Mensagem("Erro ao criar personagem", "h2","error");
            new Mensagem($mensagemCriacao, "p");
            new Mensagem("Clique <a href=\"javascript:history.go(-1)\">aqui</a> para voltar","p");

        }
        break;
    case 'excluir':
        $p = new Personagem();
        try {
            $p->carregarPorID($_POST['id']);
            $p->excluir();
            new Mensagem("Seu personagem foi excluído", "h2","ok");

        } catch (Exception $exc) {
            new Mensagem("Erro ao excluir personagem", "h2","error");
        }

}


?>
