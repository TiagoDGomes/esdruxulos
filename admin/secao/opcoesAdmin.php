<?php
function chamarAlterarSenhaAdmin() {
    ?>
<form action="?secao=opcoesAdmin&acao=trocar" method="post">
    <table>
        <tr>
            <td>Login:</td><td><input name="login" disabled="disabled" type="text" size="15" value="<?php global $SITE_ADMIN_USERNAME;echo $SITE_ADMIN_USERNAME; ?>" /></td>
        </tr>
        <tr>
            <td>Senha atual:</td><td><input name="senhaAnterior" type="password" size="15" /></td>
        </tr>
        <tr>
            <td>Nova senha:</td><td><input name="novaSenha" type="password" size="15" /></td>
        <tr>
            <td>Repita a nova senha:</td><td><input name="repetirSenha" type="password" size="15" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td><input type="submit" value="Alterar" /></td>
        </tr>

    </table>
</form>
    <?php
}

switch ($_GET['acao']) {
    case "alterarSenha":
        new Mensagem("Alterar senha do administrador", "h2");
        chamarAlterarSenhaAdmin();
        break;
    case "trocar":
        $f = new FileSystem("$SITE_DIR_ROOT/admin/fpasswd");
        echo $f->readAllFile();
        if (md5($_POST['senhaAnterior'])==md5($f->readAllFile())){
            echo "senha ok";
        }


}
?>