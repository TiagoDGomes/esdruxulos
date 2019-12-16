<?php
function incluirParaZip($diretorio,&$zip){
        $ponteiro  = opendir($diretorio);
        while ($arquivo = readdir($ponteiro)) {
            if ($arquivo!="." && $arquivo!="..") {
                $f= $diretorio .'/'. $arquivo;
                $f= str_replace('./', '', $f);
                if(!is_dir($f)) {
                    //include $diretorio ."/". $arquivo;
                    //echo "$f<br>";
                    $zip->addFile($f);
                    

                }
                else{
                    incluirParaZip($f ,$zip);
                }
            }
        }
}

switch ($_GET['opcao']) {
    case "listarArquivosParaEdicao":
    // <editor-fold defaultstate="collapsed" desc="Listar arquivos">
        ?>
<h2>Alterar arquivo do site</h2>

        <?php
        $ponteiro  = opendir(getcwd());
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
        }// </editor-fold>
        break;
    case 'backup':
        if ($_GET['ok']=='yes') {

            global $SITE_DB_USERNAME;
            global $SITE_DB_PASSWORD;
            global $SITE_DB_DBNAME;
            if ($SITE_DB_PASSWORD==""){
                $passw="";
            }
            else {
                $passw= "-p$SITE_DB_PASSWORD";
            }
            $cmd = "c:/xampp/mysql/bin/mysqldump --add-drop-database $SITE_DB_DBNAME -u $SITE_DB_USERNAME $passw>admin/sql/backup".date("YmdHim") .".sql";
            `$cmd`;
            $filename = "admin/backup.zip";
            @unlink($filename);
            $zip = new ZipArchive();
            if ($zip->open($filename, ZIPARCHIVE::CM_PKWARE_IMPLODE  )!==TRUE) {
                echo "cannot open <$filename>\n";
            }
            $diretorio = '.';
            incluirParaZip($diretorio,$zip);
            header('Content-Type: application/zip');
            header('Content-Disposition: filename="backup_esdruxulos_'.date('Y-m-d_H-i-s').'.zip"');

            $zip->close();
            $fp = fopen($filename, "r");
            while (!feof($fp)) {
                echo fread($fp, 65536);
                flush(); // this is essential for large downloads
            }
            fclose($fp);
            @unlink($filename);
        }
        else{
            echo '<a href="javascript:void(0)" onclick="javascript:window.open(\'/admin.php?secao=opcoesSite&opcao=backup&ok=yes\', \'Backup\',\'height = 300, width = 400\')">Fazer backup</a>';
        }

}
?>
