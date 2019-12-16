<?php

switch ($_GET['acao']) {
    case "criar":
    case 'editar':
    // <editor-fold defaultstate="collapsed" desc="Cadastrar anunciante">
        ?>
<h2>Anunciante</h2>
<form action="?secao=anunciante&acao=executar" method="post">
    <table>
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
            <td>Razão social: </td>
            <td><?php echo HTML::createInputTextBox('', 'razaoSocial', 90, 35, $_POST['razaoSocial']); ?></td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td><?php echo HTML::createInputTextBox('', 'email', 90, 35, $_POST['email']); ?></td>
        </tr>
        <tr>
            <td>Telefone: </td>
            <td><?php echo HTML::createInputTextBox('', 'telefone', 90, 35, $_POST['telefone']); ?></td>
        </tr>
        <tr>
            <td>Website: </td>
            <td><?php echo HTML::createInputTextBox('', 'website', 90, 35, $_POST['website']); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="salvar" value="Salvar">
            </td>
        </tr>
    </table>
</form>

        <?php
// </editor-fold>
        break;



    
    case "alterar":
         // <editor-fold defaultstate="collapsed" desc="Código que exibe a lista de anunciantes para edição">
        global $SITE_REL_PAGINAS;
        $ids = Anunciante::getListID();
        echo "<h2>Anunciantes</h2>";
        HTML::startFieldSet('Anunciantes');
        if (count($ids)!=0) {
            $ids=array_reverse($ids);
            echo '<table>';
            foreach($ids as $i) {
                echo '<tr>';
                $a = new Anunciante();
                $a->carregarPorID($i);
                echo '<td><a class="greybox" href="'.$a->getWebsite().'">'.$a->getRazaoSocial().'</a></td>';
                echo '<td>';
                HTML::startForm("?secao=anunciante&acao=editar", "POST");
                echo HTML::createHiddenInput("id", $i);
                echo HTML::createHiddenInput("razaoSocial",$a->getRazaoSocial());
                echo HTML::createHiddenInput("email",$a->getEmail());
                echo HTML::createHiddenInput("telefone",$a->getTelefone());
                echo HTML::createHiddenInput("website",$a->getWebsite());
                echo HTML::createSubmitButton("Editar","Editar");
                HTML::closeForm();
                echo '</td><td>';
                HTML::startForm("?secao=anunciante&acao=excluir", "POST","","if (!confirm('Você tem certeza em remover \'".$a->getRazaoSocial()."\' e todas as suas propagandas?')){return false;};");
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
        $mensagemCriacao = Criacao::AnunciantePorPostMethod();
        if ($mensagemCriacao=="ok") {
            new Mensagem("Anunciante salvo", "h2","ok");
        }
        else {
            new Mensagem("Erro ao cadastrar anunciante", "h2","error");
            new Mensagem($mensagemCriacao, "p");
            new Mensagem("Clique <a href=\"javascript:history.go(-1)\">aqui</a> para voltar","p");
        }// </editor-fold>
        break;
    case 'excluir':
        $a = new Anunciante();
        try {
            $a->carregarPorID($_POST['id']);
            $a->excluir();
            new Mensagem("O anunciante foi excluído", "h2","ok");

        } catch (Exception $exc) {
            new Mensagem("Erro ao excluir anunciante", "h2","error");
        }

}
?>