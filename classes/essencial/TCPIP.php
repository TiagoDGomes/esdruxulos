<?php
/**
 * TCPIP
 *
 * @author Tiago
 */


abstract class TCPIP {
    /**
     * Retorna o endereço IP do servidor
     * @return String
     */
    public static function getServerIP() {
        return $_SERVER["SERVER_ADDR"];
    }
    /**
     * Retorna o endereço IP do cliente
     * @return String
     */
    public static function getClientIP() {
        return $_SERVER["REMOTE_ADDR"];
    }
}
?>
