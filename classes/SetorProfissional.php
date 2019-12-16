<?php

class SetorProfissional extends ItemSite {
    public $usuario_list;

    public static function getListID() {
        $query = "SELECT id FROM ".get_class()." ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);
    }
    public function getNome() {
        return $this->ATRIBUTO['nome'];
    }
    public function setNome($nome) {
        $this->ATRIBUTO['nome']=$nome;
    }

    public function countUsuario() {
        return count($this->usuario_list);
    }
    public static function count() {
        return parent::countTotal(new SetorProfissional());
    }

    protected function carregarRelacionamentos() {
        $this->usuario_list = $this->carregarListaOneToMany(new Usuario(), "");
    }
    protected function salvarRelacionamentos() {
    }

}
?>
