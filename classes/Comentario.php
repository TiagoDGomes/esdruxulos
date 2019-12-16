<?php

class Comentario extends ItemSite {

    public static function getListID() {
        $query = "SELECT id FROM ".get_class()." ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);
    }
    public function getConteudo() {
        return $this->ATRIBUTO['conteudo'];
    }
    public function setConteudo($conteudo) {
        $this->ATRIBUTO['conteudo'] = $conteudo;
    }
    public function getDataPost() {
        return $this->ATRIBUTO['dataPost'];
    }
    public function setDataPost($dataPost) {
        return $this->ATRIBUTO['dataPost']=$dataPost;
    }
    public function getNota() {
        return $this->ATRIBUTO['nota'];
    }
    public function setNota($nota) {
        return $this->ATRIBUTO['nota']=$nota;
    }

    public function getHistoria() {
        $h = new Historia();
        $h->carregarPorID($this->ATRIBUTO['idHistoria']);
        return $h;
    }
    public function setHistoria($object_historia) {
        $this->ATRIBUTO['idHistoria']=$object_historia->id;
    }
    public function getUsuario() {
        $u = new Usuario();
        $u->carregarPorID($this->ATRIBUTO['idUsuario']);
        return $u;
    }
    public function setUsuario($object_Usuario) {
        $this->ATRIBUTO['idUsuario']=$object_Usuario->id;
    }
    public function salvar() {
        if (($this->ATRIBUTO['idHistoria'])==null) {
            throw new Exception("Erro para salvar. Historia não definida.");
        }else if (($this->ATRIBUTO['idUsuario'])==null) {
            throw new Exception("Erro para salvar. Usuario não definida.");
        }else {
            if ($this->getDataPost()=="") $this->setDataPost(bd::now());
            parent::salvar();
        }
    }

    protected function carregarRelacionamentos() {

    }
    protected function salvarRelacionamentos() {

    }
}
?>
