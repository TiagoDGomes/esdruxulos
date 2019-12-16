<?php
include_once 'config.php';
$linkdb = null;

/**
 * Trata as conexões com o banco de dados MySQL
 * @abstract
 * 
 * @author Tiago
  */
abstract class bd {
    /**
     *
     * Inicia conexão com banco de dados
     *
     * @global String $SITE_DB_DBNAME
     * @global String $SITE_DB_HOST
     * @global String $SITE_DB_USERNAME
     * @global String $SITE_DB_PASSWORD
     * @global resource $linkdb
     * @return int Retorna um identificador de conexão MySQL em caso de sucesso, ou FALSE  em caso de falha.
     * @link http://br.php.net/manual/pt_BR/function.mysql-connect.php
     * @link http://br.php.net/manual/pt_BR/function.mysql-select-db.php
     */
    static function startMySQLConnection() {
        global $SITE_DB_DBNAME;
        global $SITE_DB_HOST;
        global $SITE_DB_USERNAME;
        global $SITE_DB_PASSWORD;
        global $SITE_DB_PORT ;
        global $linkdb;
        $linkdb = mysql_connect($SITE_DB_HOST . ":" . $SITE_DB_PORT,  $SITE_DB_USERNAME, $SITE_DB_PASSWORD);
        mysql_select_db($SITE_DB_DBNAME);
        return $linkdb;
    }
    /**
     * Retorna a data e hora atual
     *
     * @return String Retorna uma string de acordo com a hora atual local.
     * @link http://br.php.net/manual/pt_BR/function.date.php
     * @link http://dev.mysql.com/doc/refman/4.1/pt/date-and-time-functions.html
     */
    static function now() {
        return date("Y-m-d H:i:s") ;
    }
    /**
     * Retorna o maior valor de uma coluna de uma tabela
     *
     * @param String $coluna "A coluna da tabela"
     * @param String $tabela "A tabela a ser pesquisada"
     * @return int
     *
     */
    static function max($coluna,$tabela) {
        $result = bd::executeSql("SELECT MAX($coluna) FROM $tabela");
        $row=mysql_fetch_row($result);
        return $row[0];
    }
    /**
     * Executa uma query MySQL
     * @global resource $linkdb
     * @param String $query
     * @return resource mysqlQuery
     * @link http://php.net/manual/pt-BR/function.mysql-query.php
     */
    static function executeSql($query) {
        //echo "   <b>$query</b><br>";
        //echo lista_qq_query($query);
        global $linkdb;
        return mysql_query($query,$linkdb);
    }
    /**
     * @deprecated
     */
    static function countPorQuerySQL($query) {
        $res = bd::executeSql($query);
        return mysql_num_rows($res);
    }
    /**
     * @deprecated
     */
    static function executeSqlParaObject($query, $object) {
        $resultado = bd::executeSql($query);
        return @mysql_fetch_object($result, get_class($object));
    }
    /**
     * Executa uma query MySQL e retorna uma array numerada simples
     * @param String $query
     * @return Array
     */
    static function executeSqlParaArraySimples($query) {
        $resultadoSql=bd::executeSql($query);
        $i=0;
        //print_r($resultadoSql);
        while($arr = @mysql_fetch_array($resultadoSql, MYSQL_NUM)) {
            $newArray[$i] = $arr[0];
            $i++;
        }
        return $newArray;
    }
    /**
     * Executa uma query MySQL e retorna uma array com os títulos da coluna como índices
     * @param String $query
     * @return Array
     */
    static function executeSqlParaArrayTitulada($query) {
        $resultado=bd::executeSql($query);
        return @mysql_fetch_array($resultado, MYSQL_ASSOC);
    }
    /**
     * Executa uma query SQL para obter as colunas de uma tabela
     * @param String $tabela O nome da tabela
     * @param resource $myresult Parâmetro passado por referência que terá os resultados obtidos da consulta
     * @return int A quantidade de colunas do resultado
     * @link http://php.net/manual/pt-BR/function.mysql-num-rows.php
     */
    static function showColunas($tabela, &$myresult) {
        $query = "SHOW COLUMNS FROM ".$tabela;
        $result = bd::executeSql($query);
        $myresult = $result;
        return @mysql_num_rows($result);
    }
    /**
     * Executa um arquivo SQL
     * @global String $SITE_DB_DBNAME
     * @global String $SITE_DB_HOST
     * @global String $SITE_DB_USERNAME
     * @global String $SITE_DB_PASSWORD
     * @param String $file O caminho do arquivo SQL
     */
    static function carregarArquivoSQL($file) {
        global $SITE_DB_DBNAME;
        global $SITE_DB_HOST;
        global $SITE_DB_USERNAME;
        global $SITE_DB_PASSWORD;
        $lk = mysql_connect($SITE_DB_HOST, $SITE_DB_USERNAME, $SITE_DB_PASSWORD);
        mysql_select_db($SITE_DB_DBNAME,$lk);
        $fp = fopen($file, "r");
        while (!feof($fp)) {
            $sql .= fgetc($fp);
        }
        fclose($fp);

        $query = explode(";", $sql);
        foreach ($query as $q) {
            mysql_query($q,$lk);
        }
        mysql_close($lk);
    }
}

bd::startMySQLConnection();




/**
 * @deprecated
 * @param String $query

function lista_qq_query($query) {

    $resultado = @mysql_query($query);
    if (!$resultado) {
        echo("query error: " . mysql_error() );
        exit();
    }
    echo "<table width=\"100\" border=\"1\">";
    echo "<tr bgcolor=\"#A6A6FF\">";
    while ($cabecalho = mysql_fetch_field($resultado) ) {
        echo "<th>";
        echo $cabecalho->name;
        echo "</th>";
    }
    echo "</tr>";
    while ( $linha = mysql_fetch_row($resultado) ) {
        echo"<tr>";
        for ($i=0 ; $i < mysql_num_fields($resultado);$i++ ) {
            echo "<td>".$linha[$i]."</td>";
        }
        echo "</tr>";
    }

    echo"</table>";
    mysql_free_result($resultado);
}

 */

?>
