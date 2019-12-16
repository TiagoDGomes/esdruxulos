<?php
error_reporting(E_ALL ^ E_NOTICE);

// <editor-fold defaultstate="collapsed" desc="Se alguém tentar abrir este arquivo diretamente pela URL, causará um erro 404. ">
if ($_SERVER["SCRIPT_NAME"]=="/config.php"){
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    exit;
}// </editor-fold>
// **************************************
//  VARIAVEIS GLOBAIS
//

//  Nome do site:
$SITE_TITLE = "Os esdrúxulos";

//  Banco de dados:
// <editor-fold defaultstate="collapsed" desc="Variáveis globais do banco de dados">

$SITE_DB= "mysql" ;
//  Endereço do host do banco de dados:
$SITE_DB_HOST = "localhost";
//  Porta do host do banco de dados:
$SITE_DB_PORT= 3306;
//  Nome de referência do banco de dados:

    $SITE_DB_DBNAME= "esdruxulos";
//  Nome de usuário do banco de dados
//if ($SITE_DB_USERNAME=="")
$SITE_DB_USERNAME= "root";
//  Senha do banco de dados
//if ($SITE_DB_PASSWORD=="")
$SITE_DB_PASSWORD= "";// </editor-fold>


$SITE_ADMIN_USERNAME="root";
$SITE_ADMIN_PASSWORD="senha";

$SITE_DIR_ROOT = $_SERVER["DOCUMENT_ROOT"]."/";
$SITE_URL_RELATIVE_ROOT = str_ireplace($_SERVER["DOCUMENT_ROOT"],"", dirname($_SERVER["SCRIPT_FILENAME"])."/");
$SITE_REL_PAGINAS="img/historia";
$SITE_REL_PERSONAGENS="img/personagem";
// $SITE_DIR_PAGINAS = $SITE_DIR_ROOT.$SITE_DIR_RELATIVE_PAGINAS;
$SITE_URL_RELATIVE_PAGINAS = "$SITE_URL_RELATIVE_ROOT$SITE_REL_PAGINAS/";

$SITE_DIR_PAGINAS="$SITE_DIR_ROOT$SITE_URL_RELATIVE_ROOT$SITE_REL_PAGINAS/";
$SITE_MODO_SIMPLES = 1;





?>
