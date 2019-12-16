<?php
    $USUARIO = new Usuario();
    $USUARIO->carregarPorCookie($_COOKIE['uidxdr']);
?>
<div id="dFormulario">
    <fieldset><legend>Olá, <?php if ($USUARIO->getSenhaMD5Hash()!="") echo $USUARIO->getNome(); ?></legend>

    <p>Gostaríamos de saber o que você achou do nosso trabalho.</p>
    <p>Tudo bem... Pode ser sincero(a). Não vamos te xingar. Prometemos.</p>

    <form action="?" method="post">
        <textarea cols="40" rows="10"></textarea>

        <div id="dBotoesEnviarApagar">
            <br />
            <input type="submit" value="Enviar" />
            <input type="reset" value="Apagar" />
        </div>
    </form></fieldset>
</div>