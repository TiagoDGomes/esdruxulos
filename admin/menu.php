
    <ul>
        <li id="historia">Histórias
            <ul>
                <li class="novo"><a href="?secao=historia&amp;acao=criar">Criar uma nova história</a></li>
                <li class="edit"><a href="?secao=historia&amp;acao=alterar">Alterar/excluir uma história</a></li>
                <li class="novo"><a href="?secao=humor">Humor</a></li>

            </ul>

        </li>
        <li id="personagem">Personagens
            <ul>
                <li><a href="?secao=personagem&amp;acao=criar">Adicionar um novo personagem</a></li>
                <li><a href="?secao=personagem&amp;acao=alterar">Alterar/excluir personagem</a></li>

            </ul>
        </li>

     
        
        <li id="anunciante">Anunciante
            <ul>
                <li><a href="?secao=anunciante&amp;acao=criar">Cadastrar anunciante</a></li>
                <li><a href="?secao=anunciante&amp;acao=alterar">Alterar/excluir anunciante</a></li>
                <li id="propaganda">Propaganda
                    <ul>
                        <li><a href="?secao=propaganda&amp;acao=criar">Adicionar propaganda</a></li>
                        <li class="edit"><a href="?secao=propaganda&amp;acao=alterar">Alterar/excluir propaganda</a></li>


                    </ul>
                </li>
            </ul>


<!--
        <li id="preferencia">Preferência
            <ul>
                <li><a href="?secao=preferencia&amp;acao=criar">Adicionar prefer&amp;ecirc;ncia</a></li>
                <li>Alterar preferência</li>
            </ul>
        </li>
-->

                <li id="user"><a href="?acao=exibir&amp;secao=usuario">Gerenciar usuários</a></li>
                <!--<li class="edit"><a href="?secao=usuario&amp;acao=setoresProfissionais">Setores profissionais</a></li>-->



        <li id="admin">Administrador
            <ul class="edit">
                <li><a href="?secao=opcoesAdmin&amp;acao=alterarSenha">Alterar senha</a></li>
            </ul>

        </li>
        <li id="opcoes">Opções gerais do site
            <ul>
                <!--<li><a href="?secao=opcoesSite&amp;acao=listarArquivosParaEdicao">Alterar arquivo (modo edição)</a></li>-->
                <!--<li><a href="?secao=opcoesSite&amp;opcao=backup">Fazer um backup de todo o site</a></li>-->
                <!--<li><a href="javascript:void(0)" onclick="javascript:window.open('/admin.php?secao=opcoesSite&amp;opcao=backup&amp;ok=yes', 'Backup','height = 300, width = 400')">Fazer backup de todo o site</a></li>-->
                <li><a href="/admin.php?secao=opcoesSite&amp;opcao=backup&amp;ok=yes" onclick="document.getElementById('wait').innerHTML='<br>(isso pode demorar alguns segundos, <br>dependendo do quantidade de dados...)'">Fazer o download do backup do site</a><span style="font-size: 7pt;" id="wait"></span></li>
            </ul>
        </li>
        <!--<li><a href="?secao=teste">Teste PHP</a></li>-->
    </ul>
