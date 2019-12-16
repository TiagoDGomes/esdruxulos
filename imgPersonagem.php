<?php
include 'system.php';
$url = explode("/", $_GET['url']);
$p = new Personagem();
        try {
            $p->carregarPorID($url[0]);
            $file = $p->getImagem();
            $rename = $p->getNome();
            $fo = "{$SITE_DIR_ROOT}img/personagem/$file";
            // seconds, minutes, hours, days
            $expires = 60*60*24*360;
            header("Pragma: public");
            header("Cache-Control: maxage=".$expires);
            header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
            header("Content-Length: " . filesize($fo));
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
            echo "<p></p>";
        }

//}
?>
