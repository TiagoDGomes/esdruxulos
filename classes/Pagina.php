<?php

class Pagina extends ItemSite {

    public static function getListID() {
        $query = "SELECT id FROM ".get_class()." ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);
    }
    public function getCaminho() {
        return $this->ATRIBUTO['caminho'];
    }
    public function getCaminhoCache(){
       $h = $this->getHistoria();
        return "/pagina/".
            $h->getFormato()->getNome_lcase()."/".
            $h->getID(). "/".
            $this->getIndice();
                ;
    }
    public function setCaminho($caminho) {
        $this->ATRIBUTO['caminho']=$caminho;
    }
    public function getTipo() {
        return $this->ATRIBUTO['caminho'];
    }
    public function setTipo($tipo) {
        $this->ATRIBUTO['tipo']=$tipo;
    }
    public function getIndice() {
        return $this->ATRIBUTO['indice'];
    }
    public function setIndice($indice) {
        $this->ATRIBUTO['indice']=$indice;
    }
    public function getHistoria() {
        $h = new Historia();
        $h->carregarPorID($this->ATRIBUTO['idHistoria']);
        return $h;
    }
    public function setHistoria($object_historia) {
        $this->ATRIBUTO['idHistoria']=$object_historia->id;
    }


    public function salvar() {
        if (($this->ATRIBUTO['idHistoria'])!=null) {
            parent::salvar();

        }else {
            throw new Exception("Erro para salvar. Historia não definida para pagina ID".$this->id);
        }
    }
    protected function carregarRelacionamentos() {

    }
    protected function salvarRelacionamentos() {
    }

}
?>
