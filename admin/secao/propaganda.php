<?php

switch($_GET['acao']) {
    case "criar":
        case 'editar':
    // <editor-fold defaultstate="collapsed" desc="Criar/Editar propaganda">
        ?>
<h2>Propaganda</h2>
<form action="?secao=propaganda&acao=executar" method="post">
    <?php echo HTML::createHiddenInput('id', $_POST['id']); ?>
    <table id="tabela">
        <tr>
            <td>Anunciante:</td>
            <td><?php
                 if ($_POST['nomeAnunciante']==""){
                        try {
                            Listagem::exibirListaAnunciantesSelect();
                        } catch (Exception $exc) {
                            echo "<b>Nenhum anunciante cadastrado. Clique ".
                                    HTML::createLink("?secao=anunciante&acao=criar", "aqui").
                                    " para cadastrar um anunciante.</b>";
                            $submitDisabled=TRUE;
                        }
                 }
                 else {
                     echo $_POST['nomeAnunciante'];
                     echo HTML::createHiddenInput('idAnunciante', $_POST['idAnunciante']);
                 }
                        ?>
            </td>
        </tr>
        <tr>
            <td>T&iacute;tulo Propaganda:</td>
            <td><?php echo HTML::createInputTextBox("titulo", "titulo",35,50,$_POST['titulo']) ?></td>
        </tr>
        <tr>
            <td>Conteúdo HTML: </td>
            <td><?php echo HTML::createTextArea("conteudo", "conteudo", 5, 50,$_POST['conteudo']); ?></td>
        </tr>

        <tr>

            <td>Tipo de humor</td>
            <td style="border:1px dotted black"><?php
                        try {
                            Listagem::exibirListaHumorCheckBox();
                        } catch (Exception $exc) {
                            new Mensagem($exc->getMessage(),"b");
                            $submitDisabled=TRUE;
                        }
                        ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo HTML::createSubmitButton("enviar", "Salvar",$submitDisabled) ?></td>
        </tr>



    </table>
</form>
        <?php
//// </editor-fold>

        break;
    case "alterar":
    // <editor-fold defaultstate="collapsed" desc="Código que exibe a lista de anunciantes para edição">
        global $SITE_REL_PAGINAS;
        $ids = Anunciante::getListID();
        echo "<h2>Propagandas dos anunciantes</h2>";
        if (count($ids)!=0) {
            $ids=array_reverse($ids);
            echo '<table>';
            foreach($ids as $i) {
                $a = new Anunciante();
                $a->carregarPorID($i);
                //HTML::startFieldSet($a->getRazaoSocial());
                //echo '<table>';
                echo '<th colspan="3">Anunciante: '.HTML::createLink($a->getWebsite(), $a->getRazaoSocial()).'</th>';
                for ($index = 0; $index < $a->countPropaganda(); $index++) {
                    $pp = $a->getPropaganda($index);
                    echo '<tr>';

                    echo '<td>'.$pp->getNome().'</td>';
                    echo '<td>';
                    HTML::startForm("?secao=propaganda&acao=editar", "POST");
                    echo HTML::createHiddenInput("id", $i);

                    echo HTML::createHiddenInput('id', $pp->getID());
                    echo HTML::createHiddenInput('idAnunciante', $a->getID());
                    echo HTML::createHiddenInput('nomeAnunciante', $a->getRazaoSocial());

                    echo HTML::createHiddenInput('titulo', $pp->getNome());
                    echo HTML::createHiddenInput('conteudo', htmlentities($pp->getConteudo()));

                    echo HTML::createSubmitButton("Editar","Editar");
                    HTML::closeForm();
                    echo '</td><td>';
                    HTML::startForm("?secao=propaganda&acao=excluir", "POST","","if (!confirm('Você tem certeza em remover \'".$pp->getNome()."\' de ".$pp->getAnunciante()->getRazaoSocial()."')){return false;};");
                    echo HTML::createHiddenInput("id", $pp->getID());
                    echo HTML::createSubmitButton("Excluir","Excluir");
                    HTML::closeForm();
                    echo '</td>';
                    echo "</tr>\n";
                }
                echo '<tr><td colspan="3">&nbsp;</td></tr>';
                //echo "</table>\n";
                //HTML::closeFieldSet();
            }
            echo '</table>';
        }

        // </editor-fold>

        break;

    case "executar":
        $mensagemCriacao = Criacao::PropagandaPorPostMethod();
        if ($mensagemCriacao=="ok") {
            new Mensagem("Propaganda salva", "h2","ok");
        }
        else {
            new Mensagem("Erro ao registrar propaganda", "h2","error");
            new Mensagem($mensagemCriacao, "p");
            new Mensagem("Clique <a href=\"javascript:history.go(-1)\">aqui</a> para voltar","p");
        }// </editor-fold>
        break;
    case 'excluir':
        $pp = new Propaganda();
        try {
            $pp->carregarPorID($_POST['id']);
            $pp->excluir();
            new Mensagem("A propaganda foi excluída", "h2","ok");

        } catch (Exception $exc) {
            new Mensagem("Erro ao excluir propaganda", "h2","error");
        }


}
