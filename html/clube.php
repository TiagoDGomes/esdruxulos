<script type="text/javascript">
    function verlogin(){
        resetOpt();
        document.getElementById('login').style.display='block';
        document.getElementById('ll').style.fontWeight='bold';
        document.getElementById('ll').style.backgroundColor='orange';

    }
    function vercadastro(){
        resetOpt();
        document.getElementById('newF').style.display='block';
        document.getElementById('lc').style.fontWeight='bold';
        document.getElementById('lc').style.backgroundColor='orange';

    }
    function resetOpt(){
        document.getElementById('newF').style.display='none';
        document.getElementById('login').style.display='none';
        document.getElementById('ll').style.fontWeight='normal';
        document.getElementById('lc').style.fontWeight='normal';
        document.getElementById('ll').style.backgroundColor='white';
        document.getElementById('lc').style.backgroundColor='white';

    }
    function checar(){
        var erro;
        var n = document.getElementById('nome').value;
        var e = document.getElementById('endereco').value;
        var c = document.getElementById('cidade').value;
        var b = document.getElementById('bairro').value;
        var lg = document.getElementById('loginC').value;
        var s1 = document.getElementById('senhaC').value;
        var s2 = document.getElementById('senha2C').value;
        var erro = "";
        
        if (n==""){
            erro += "- Você não preencheu o seu nome.\n";
        }
        if (e==""){
            erro += "- Você não preencheu o endereço.\n";
        }
        if (c==""){
            erro += "- Você não definiu a sua cidade.\n";
        }
        if (b==""){
            erro += "- Você não definiu o seu bairro.\n";
        }

        if (lg==""){
            erro += "- Você não definiu o seu login.\n";
        }
        if (s1==""){
            erro +="- Você não definiu a sua senha.\n";
        }
        else if (s2==""){
            erro += "- Você não redigitou a sua senha.\n";
        }
        if(s1!=s2){
            erro +="- As senhas não coincidem.\n";
        }
        if (erro != ""){
            alert ("Você não completou os seguintes itens: \n" + erro);
            return false;
        }
        else{
            return true;
        }
    }
</script>
<div id="dFormulario">

    <h2>F&atilde; Clube</h2>

    <div style="padding-bottom: 15px;">
        <?php
        if ($USUARIO->getNome()==null){
        ?><a id="ll" href="javascript:void(0)" onclick="verlogin()">Eu já sou cadastrado</a>&nbsp;
          <a id="lc" href="javascript:void(0)" onclick="vercadastro()">Eu quero me cadastrar</a><?php

        ?>
    </div>
    <div id="login" style="display: none">
        <fieldset class="itensCadastro">
            <legend>Faça o seu login</legend>
            <form action="/login.php" method="post">
                <table>
                    <tr>
                        <td>Nome de usuário ou e-mail:</td>
                        <td><input name="nomeUsuario" type="text" size="25"  ></td>

                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input name="senhaUsuario" type="password" size="25"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input name="login" type="submit" value="Login" /></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </div>

    <div id="newF" style="display: none">
        <p>Gostaria de se tornar f&atilde; dos esdr&uacute;xulos e receber
            not&iacute;cias fresquinhas no seu email sobre o site,
            tiras, novidades e muito mais?
            Ah! O melhor de tudo, é GRÁTIS, como a ARTE deve ser.</p>
        <p><sup>(*)Preechimento obrigatório</sup></p>
        <form id="fCadastro" action="/cadastro.php" method="post" onsubmit="return checar();">
            <fieldset class="itensCadastro">
                <legend>Dados pessoais</legend>
                <table>
                    <tr>
                        <td><label for="nome">Nome:</label></td>
                        <td><input id="nome" name="nome" type="text" maxlength="300" size="32" <?php if($USUARIO->getId()!=null) echo 'value="'.$USUARIO->getNome() . '"'; ?> />
                            </td>
                    </tr>
                    <tr>
                        <td><label for="endereco">Endere&ccedil;o:</label></td>
                        <td><input id="endereco" name="endereco" type="text" maxlength="300" size="32" <?php if($USUARIO->getId()!=null) echo 'value="'.$USUARIO->getEndereco() . '"'; ?> /></td>
                    </tr>
                    <tr>
                        <td><label for="bairro">Bairro:</label></td>
                        <td><input id="bairro" name="bairro" type="text" maxlength="100" size="20" <?php if($USUARIO->getId()!=null) echo 'value="'.$USUARIO->getBairro() . '"'; ?> /></td>
                    </tr>
                    <tr>
                        <td><label for="cidade">Cidade:</label></td>
                        <td><input id="cidade" name="cidade" type="text" maxlength="100" size="20" <?php if($USUARIO->getId()!=null) echo 'value="'.$USUARIO->getCidade() . '"'; ?> /></td>
                    </tr>
                    <tr>
                        <td><label for="estado">Estado:</label></td>
                        <td><?php
                        if($USUARIO->getId()!=null) $eid=$USUARIO->getEstado()->getID();
                        Listagem::exibirListaEstadosSelect($eid);
                        ?></td>
                    </tr>
                    <tr>
                        <td><label for="email">e-mail:</label></td>
                        <td><input id="email" name="email" type="text"  maxlength="65" size="30" <?php if($USUARIO->getId()!=null) echo 'value="'.$USUARIO->getEmail() . '"'; ?> /></td>
                    </tr>
                    <tr>
                        <td><label for="telefone">Telefone:</label></td>
                        <td><input id="telefone" name="telefone" type="text" maxlength="10" size="30" <?php if($USUARIO->getId()!=null) echo 'value="'.$USUARIO->getNome() . '"'; ?> /></td>
                    </tr>
                    <tr><td><br /></td></tr>


                    <tr>
                        <td>Data de nascimento:</td>
                        <td><?php HTML::showInputCalendar("diaNasc","mesNasc","anoNasc"); ?></td>
                    </tr>

                    <tr><td><br /></td></tr>

                    <tr>
                        <td>Sexo:</td>
                        <td><input type="radio" id="sm" name="sexo" value="M"/><label for="sm">Masculino</label>
                            <input type="radio" id="sf" name="sexo" value="F"/><label for="sf">Feminino</label></td>
                    </tr>
                </table>
            </fieldset>
            <!--
            <fieldset class="itensCadastro">
                <legend>
                    Que tipo de quadrinhos você mais gosta?
                </legend>
                <table>
                    <tr>
                        <td>
                            <?php Listagem::exibirListaHumorCheckBox(); ?>
                        </td>
                    </tr>

                </table>
            </fieldset>
            -->
            <table>
                <tr>
                    <td><label for="login">Nome de usuário:</label></td>
                    <td><input id="loginC" name="loginC" type="text" maxlength="30" value="" /></td>
                </tr>
                <tr>
                    <td><label for="senha">Escolha uma senha:</label></td>
                    <td><input id="senhaC" name="senhaC" type="password" maxlength="30" /></td>
                </tr>
                <tr>
                    <td><label for="senha2">Confirme a senha:</label></td>
                    <td><input id="senha2C" name="senha2C" type="password" maxlength="30" /></td>
                </tr>
                <tr>
                    <td>
                        <br />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Cadastrar" />
                        <input type="reset" value="Apagar" />
                    </td>
                </tr>
            </table>

        </form>
        <?php
            if ($url[1]=="login"){
                ?><script type="text/javascript">
                    verlogin();
                  </script>
                <?php
            }
        ?>
    

<?php
}else{
            ?>

            <?php
        }
?></div></div>