<?php
include 'system.php';
$url = explode("/", $_GET['url']);
switch ($url[0]) {
    case 'quadrinho':
    case 'tira':
        $historia = new Historia();
        try {
            $historia->carregarPorID($url[1]);
            $file = $historia->getPagina($url[2])->getCaminho();
            $rename = $historia->getTitulo()."_p".
                    $url[2].".". end(explode(".", $historia->getPagina($url[2])->getCaminho()));
            $fo = "{$SITE_DIR_ROOT}img/historia/$file";
            // seconds, minutes, hours, days
            $expires = 60*60*24*360;
            header("Pragma: public");
            header("Cache-Control: maxage=".$expires);
            header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
            header("Content-Length: " . filesize($fo));
            header("Content-Type: ".$historia->getPagina($url[2])->getTipo());
            header("Content-Disposition: filename=\"$rename\"");
            $fp = fopen($fo, "r");
            while (!feof($fp)) {
                echo fread($fp, 65536);
                flush(); // this is essential for large downloads
            }
            fclose($fp);
        } catch (Exception $exc) {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>Not Found</h1>";
            echo "<p>:-P</p>";
        }

}
?>
