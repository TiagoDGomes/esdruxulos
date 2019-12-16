<?php

class Humor extends ItemSite {
    public $historia_list;
    public $propaganda_list;
    public $usuario_list;

    public static function getListID() {
        $query = "SELECT id FROM ".get_class()." ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);
    }
    public static function count() {
        return parent::countTotal(new Humor());
    }
    public function countHistoria() {
        return count($this->historia_list);
    }
    public function countPropaganda() {
        return count($this->propaganda_list);
    }
    public function countPreferencia() {
        return count($this->preferencia_list);
    }
    public function getNome() {
        return $this->ATRIBUTO['nome'];
    }
    public function setNome($nome) {
        $this->ATRIBUTO['nome']=$nome;
    }
    public function getDescricao() {
        return $this->ATRIBUTO['descricao'];
    }
    public function setDescricao($descricao) {
        $this->ATRIBUTO['descricao']=$descricao;
    }
    public function getHistoria($index) {
        $h = new Historia();
        $h->carregarPorID($this->historia_list[$index]);
        return $h;
    }
    public function setHistoria ($index, $object_historia) {
        $this->historia_list[$index]=$object_historia->id;
    }
    public function getPropaganda($index) {
        $p = new Propaganda();
        $p->carregarPorID($this->propaganda_list[$index]);
        return $p;
    }
    /**
     *
     * @return Propaganda
     */
    public function getPropagandaAleatoria() {
        $p = new Propaganda();
        $x = rand(0, $this->countPropaganda()-1);
        try {
            $p->carregarPorID($this->propaganda_list[$x]);
            return $p;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
        }

    }
    public function setPropaganda($index,$object_propaganda) {
        $this->propaganda_list[$index]=$object_propaganda->id;
    }
    public function getUsuario($index) {
        $p = new Usuario();
        $p->carregarPorID($this->usuario_list[$index]);
        return $p;
    }
    public function setUsuario($index, $object_usuario) {
        $this->usuario_list[$index]=$object_usuario->id;
    }
    public function salvar() {
        if ($this->getNome()==null) {
            throw new Exception("Humor sem definicao de nome.");
        }else {
            parent::salvar();
        }
    }

    public function excluir() {

    }
    protected function carregarRelacionamentos() {
        $this->historia_list = $this->carregarListaManyToMany(new Historia(), "HistoriaHumor","");
        $this->propaganda_list = $this->carregarListaManyToMany(new Propaganda(), "HumorPropaganda","");
        $this->usuario_list = $this->carregarListaManyToMany(new Usuario(),"UsuarioHumor", "");

    }
    protected function salvarRelacionamentos() {
        $this->salvarListaManyToMany(new Propaganda(), "humorpropaganda", $this->propaganda_list);
        $this->salvarListaManyToMany(new Preferencia(), "preferenciahumor", $this->preferencia_list);
    }

}
?>
