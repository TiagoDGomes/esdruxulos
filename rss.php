<?xml version="1.0" encoding="utf-8"?>
<rss version="0.91"><?php
include 'system.php';
$url = explode("/", $_GET['url']);
switch ($url[0]) {

    case 'historias':

?>
    <channel>
        <title>Os esdrúxulos</title>
        <link>http://<?php echo $_SERVER["HTTP_HOST"] ?></link>
        <description><?php  ?></description>
        <language>pt-BR</language>
        <image>
            <title>Os esdrúxulos</title>
            <url>http://<?php echo $_SERVER["HTTP_HOST"] ?>/img/osesdruxulos_logo.png</url>
            <link>http://<?php echo $_SERVER["HTTP_HOST"] ?></link>
            <width>60</width>
            <height>60</height>
            <description>Os esdrúxulos</description>
        </image>
                <?php

                $hids = Historia::getListID(" ORDER BY dataInsercao DESC LIMIT 0 , 30");
                if (count($hids)>0) {
                    foreach($hids as $hid) {
                        $h = new Historia();
                        $h->carregarPorID($hid);
                        ?>

        <item>
            <title><?php
                                $d = date_parse_from_format("Y-m-d H:i:s", $h->getDataInsercao());
                                //echo $d . " " . $h->getTitulo();
                                //print_r($d);
                                echo $d['day']."/".$d['month']."/". $d['year'] . " - " . $h->getTitulo();
                                ?></title>
            <link>http://<?php echo $_SERVER["HTTP_HOST"] . $h->getURLHistoria(); ?></link>
            <description><?php echo $h->getDescricao(); ?>
            </description>
            <pubDate><?php echo date("D, d M Y H:i:s",mktime($d['hour'], $d['minute'], $d['second'], $d['month'], $d['day'], $d['year'])) ?> -0300</pubDate>
        </item>
                        <?php
                    }
                }
                ?>

    </channel>

        <?php
        break;
}
?>
</rss>