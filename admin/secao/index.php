<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $diretorio = getcwd();
        $ponteiro  = opendir($diretorio);
        while ($nome_itens = readdir($ponteiro)) {
            $itens[] = $nome_itens;
        }
        sort($itens);
        foreach ($itens as $listar) {
            if ($listar!="." && $listar!="..") {
                if (is_dir($listar)) {
                    $pastas[]=$listar;
                } else {
                    $arquivos[]=$listar;
                }
            }

        }
        if ($pastas != "" ) {
            foreach($pastas as $listar) {
                print "Pasta: <a href='$listar'>$listar</a><br>";
            }
            if ($arquivos != "") {
                foreach($arquivos as $listar) {
                    print " Arquivo: <a href='$listar'>$listar</a><br>";
                }
            }
        }


?>

    </body>
</html>
