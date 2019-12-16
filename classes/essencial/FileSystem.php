<?php
/**
 * Tratamento de arquivos
 *
 * @author Tiago
 */
class FileSystem {
    private $filename;
    private $pointer;
    function __construct($filename) {
        $this->filename = $filename;
    }
    /**
     * Lê todo o conteúdo de um arquivo
     */
    function readAllFile() {
        $this->pointer = fopen($this->filename, "r");
        while (!feof($this->pointer)) {
            $txt .= fgetc($this->pointer);
        }
        fclose($this->pointer);
    }

}
?>
