<?php
// <editor-fold defaultstate="collapsed" desc="Se alguém tentar abrir este arquivo diretamente pela URL, causará um erro 404. ">
if ($_SERVER["SCRIPT_NAME"]=="/system.php") {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    exit;
}// </editor-fold>

function includeFolder($diretorio) {
    // <editor-fold defaultstate="collapsed" desc="Inclui todos os arquivos contidos em um diretório.">
$ponteiro  = opendir($diretorio);
while ($arquivo = readdir($ponteiro)) {
    if ($arquivo!="." && $arquivo!="..") {
        if(!is_dir($diretorio ."/". $arquivo)) {
            include $diretorio ."/". $arquivo;
        }
    }
}// </editor-fold>
}
include_once 'config.php';
includeFolder ("classes/essencial");
includeFolder ("classes");


?>
