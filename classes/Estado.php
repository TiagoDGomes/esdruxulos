<?php

class Estado extends ItemSite {
    /**
     *
     * @var Array
     */
    public $usuario_list;
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
    public function countUsuario() {
        return count($this->usuario_list);
    }
    public function carregarListaDeUsuarios() {
        $this->usuario_list = $this->carregarListaOneToMany(new Usuario(),"" );
    }
    /**
     *
     * @param Integer $index
     * @return Usuario
     */
    public function getUsuario($index) {
        $u = new Usuario();
        $u->carregarPorID($this->ATRIBUTO[$this]);
        return $u;
    }
    /**
     *
     * @return String
     */
    public function getNome() {
        return $this->ATRIBUTO['nome'];
    }
    /**
     *
     * @param String $nome
     */
    public function setNome($nome) {
        $this->ATRIBUTO['nome'] = $nome;
    }
    /**
     *
     * @return Integer
     */
    public function getCodigo() {
        return $this->ATRIBUTO['codigo'];
    }
    /**
     *
     * @param String $codigo
     */
    public function setCodigo($codigo) {
        $this->ATRIBUTO['codigo'] = $codigo;
    }
    public function salvar() {
        if ($this->getCodigo()==null) {
            throw new Exception("Erro ao salvar. Codigo do estado não definido.");
        }else if ($this->getNome()==null) {
            throw new Exception("Erro ao salvar. Nome do estado não definido.");
        } else {
            parent::salvar();

        }
    }

    public function excluir(){

    }
    protected function carregarRelacionamentos() {
    }
    protected function salvarRelacionamentos() {
    }
    /**
     *
     * @return Integer
     */
    public static function count(){
        return parent::countTotal(new Estado());
    }
}
?>
