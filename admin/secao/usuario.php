<?php 
switch ($_GET['acao']) {
    case 'usuario':
        ?><h2>Detalhes do usuário</h2>
<table>
            <?php
            try {
                $u = new Usuario();
                $u->carregarPorID($_GET['id']);
                echo "<tr><td>Nome:</td><td>$u</td></tr>";
                echo "<tr><td>Endereço:</td><td>{$u->getEndereco()}</td></tr>";
                echo "<tr><td>Bairro:</td><td>{$u->getBairro()}</td></tr>";
                echo "<tr><td>Cidade:</td><td>{$u->getCidade()}</td></tr>";
                echo "<tr><td>Estado:</td><td>{$u->getEstado()->getNome()}</td></tr>";
                echo "<tr><td>E-mail:</td><td>".HTML::createlinkEmail($u->getEmail(), $u->getEmail())."</td></tr>";
                echo "<tr><td>Login:</td><td>{$u->getLogin()}</td></tr>";
                ?><tr>
        <td>Preferências do usuário:</td>
        <td><img alt="" src="/grafico.php?nome=Preferencias<?php
                        $huids = Humor::getListID();
                        $i=0;
                        foreach($huids as $huid) {
                            $hm = new Humor();
                            $hm->carregarPorID($huid);
                            if ($hm->getNome()!="Todos") {
                                echo "&amp;n[$i]=".$hm->getNome();
                                echo "&amp;v[$i]=".$u->getNumeroDeVisitasPorHumor($hm);
                                $i++;

                            }
                            
                        }
                             ?>" />
        </td>
    </tr><?php

            } catch (Exception $exc) {
                new Mensagem("ID de usuário inválido", "h2","error");
            }

            ?></table><?php
        break;


    case 'excluir':
        try {
            $u = new Usuario();
            $u->carregarPorID($_POST['id']);
            $u->excluir();
            new Mensagem("O usuário foi excluído", "h2","ok");

        } catch (Exception $exc) {
            new Mensagem("Erro ao excluir usuário", "h2","error");
        }

        break;

    case 'exibir':
        echo '<h2>Usuários</h2>';
        if ($_GET['exibir']=='cadastrados') {
            $parSQL = " where usuario.senha <> '' ";
            $linkParaExibicao = HTML::createLink('?acao=exibir&secao=usuario&exibir=todos', 'Clique aqui para exibir todos os usuários');
        }
        else {
            $linkParaExibicao = HTML::createLink('?acao=exibir&secao=usuario&exibir=cadastrados', 'Clique aqui para exibir somente os usuários cadastrados');

        }
        $uids = Usuario::getListID($parSQL. ' ORDER BY ultimoAcesso DESC');
        if (count($uids)>0) {
            ?>
<table border="1" style="border:1px outset black">
    <tr>
        <th colspan="6">&nbsp;</th>
        <th rowspan="2">Ações</th>
    </tr>
    <tr>
        <th>ID</th>
        <th style="width: 190px">Nome do usuário</th>
        <th style="width: 130px">E-mail</th>
        <th>Clicks de visitas</th>
        <th style="width: 120px">Data da última visita</th>
        <th style="width: 80px">Último IP</th>
                    <?php
                    //Listagem::exibirListaFormatosTh();
                    ?>

    </tr>
                <?php
                foreach ($uids as $id) {
                    $u = new Usuario();
                    $u->carregarPorID($id);
                    if($u->getNome()=="")$nomeGen='usuário com ID número '.$u->getID();
                    else $nomeGen=$u->getNome();
                    echo '<tr>';
                    echo '<td>'.$id.'</td>';
                    echo '<td>'.HTML::createLink("?secao=usuario&acao=usuario&id=".$u->getID(), $nomeGen).'</td>';
                    echo '<td>'.HTML::createlinkEmail($u->getEmail(), $u->getEmail()).'</td>';
                    echo '<td>'.$u->getNumeroDeVisitas().'</td>';
                    echo '<td>'.$u->getUltimoAcesso().'</td>';
                    echo '<td>'.$u->getUltimoIP().'</td>';
                    echo '<td>';
                    HTML::startForm('?secao=usuario&acao=excluir', 'POST','',"if (!confirm('Fazendo isso você irá exclur todas as preferências, comentários e histórico de navegação deste usuário. Você tem certeza em remover ".$nomeGen."?')){return false;};");
                    echo HTML::createHiddenInput('id', $u->getID());
                    echo HTML::createSubmitButton('excluir', 'Excluir');
                    HTML::closeForm();
                    echo '</td>';
                    echo '</tr>';

                }
                ?>
</table>
            <?php

        }
        else {
            echo 'Nenhum usuário.';
        }
        if (Usuario::count()>0) {
            echo '<br>'. $linkParaExibicao;
        }

}

?>