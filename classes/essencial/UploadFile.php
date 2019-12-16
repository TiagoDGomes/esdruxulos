<?php

/**
 * Classe UploadFile
 *
 * Trata arquivos enviados pelo método POST
 *
 * @author Tiago
 * 
 */
class UploadFile {
    private $file_string;
    function __construct($post_file_string) {
        $this->file_string = $post_file_string;
    }
    function getExtension() {
        return end(explode(".", $_FILES[$this->file_string]['name']));
    }
    function getTmpName() {
        return $_FILES[$this->file_string]['tmp_name'];
    }
    function getSize() {
        return $_FILES[$this->file_string]['size'];
    }
    function getFilename() {
        return $_FILES[$this->file_string]['name'];
    }
    function getType() {
        return $_FILES[$this->file_string]['type'];
    }
    function getErrorCode() {
        return $_FILES[$this->file_string]['error'];
    }
    function moveFile($destination) {
        move_uploaded_file($_FILES[$this->file_string]['tmp_name'], $destination);
        unset($this);
    }
}














class UploadFileArray {
    private $file_string;
    function __construct($post_file_string) {
        $this->file_string = $post_file_string;
    }
    function getExtension($index) {
        return end(explode(".", $this->getFilename($index)));
    }
    function count() {
        return count($_FILES[$this->file_string]['tmp_name']);
    }
    function getTmpName($index) {
        return $_FILES[$this->file_string]['tmp_name'][$index];
    }
    function getSize($index) {
        return $_FILES[$this->file_string]['size'][$index];
    }
    function getFilename($index) {
        return $_FILES[$this->file_string]['name'][$index];
    }
    function getType($index) {
        return $_FILES[$this->file_string]['type'][$index];
    }
    function getErrorCode($index) {
        return $_FILES[$this->file_string]['error'][$index];
    }
    function moveFile($index,$destination) {
        move_uploaded_file($_FILES[$this->file_string]['tmp_name'][$index], $destination);
    }
}

?>
