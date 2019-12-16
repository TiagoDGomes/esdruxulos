<?php

class Formato extends ItemSite {
    public $historia_list;

    /**
     *
     * @return Array
     */

    public static function getListID() {
        $query = "SELECT id FROM ".get_class()." ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);
    }
    /**
     *
     * @return Integer
     */
    public function countHistoria() {
        return count($this->historia_list);
    }
    /**
     *
     * @return String
     */
    public function getNome() {
        return $this->ATRIBUTO['nome'];
    }
    public function getLayout() {
        return $this->ATRIBUTO['layout'];
    }
    /**
     *
     * @param String $nome
     */
    public function setNome($nome) {
        $this->ATRIBUTO['nome']=$nome;
    }
    /**
     *
     * @param String $layout
     */
    public function setLayout($layout) {
        $this->ATRIBUTO['layout']=$layout;
    }
    public function getHistoria($index) {
        $h = new Historia();
        $h->carregarPorID($this->historia_list[$index]);
        return $h;
    }


    public function excluir() {

    }
    protected function carregarRelacionamentos() {
        $this->historia_list = $this->carregarListaOneToMany(new Historia(), "");
    }
    protected function salvarRelacionamentos() {

    }
    /**
     *
     * @return Integer
     */
    public static function count() {
        return parent::countTotal(new Formato());
    }
    public function getNome_lcase(){
        return strtolower($this->getNome());
    }
}
?>
