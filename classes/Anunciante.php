<?php

class Anunciante extends ItemSite implements ItemContagem {
    /**
     *
     * @var Array
     */
    public $propaganda_list;

    /**
     * Anunciante é a empresa que detém as propagandas
     * a serem exibidas no site.
     *
     */
    function __construct() {

    }
    /**
     *
     * @return Array
     */
    public static function getListID() {
        $query = "SELECT id FROM ".get_class()." ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);
    }

    /**
     * Retorna o nome do anunciante (Razão Social)
     *
     * @return String
     */
    public function getRazaoSocial() {
        return $this->ATRIBUTO['razaoSocial'];
    }

    /**
     * Altera o nome do anunciante (Razão Social)
     *
     * @param String $nome
     *
     */
    public function setRazaoSocial($nome) {
        $this->ATRIBUTO['razaoSocial']=$nome;
    }

    /**
     * Retorna a URL do site do anunciante
     *
     * @return String
     */
    public function getWebsite() {
        return $this->ATRIBUTO['website'];
    }

    /**
     * Altera a URL do site do anunciante
     *
     * @param String $url
     *
     */
    public function setWebsite($url) {
        $this->ATRIBUTO['website']=$url;
    }
    /**
     * Retorna o e-mail do anunciante
     *
     * @return String
     */
    public function getEmail() {
        return $this->ATRIBUTO['email'];
    }

    /**
     * Altera o e-mail do anunciante
     *
     * @param String $email
     *
     */
    public function setEmail($email) {
        $this->ATRIBUTO['email']=$email;
    }
    /**
     * Retorna o telefone do anunciante
     *
     * @return String
     */
    public function getTelefone() {
        return $this->ATRIBUTO['telefone'];
    }

    /**
     * Altera o telefone do anunciante
     *
     * @param String $telefone
     *
     */
    public function setTelefone($telefone) {
        $this->ATRIBUTO['telefone']=$telefone;
    }
    /**
     * Retorna a quantidade de propagandas de um anunciante
     *
     * @return Integer
     */
    public function countPropaganda() {
        return count($this->propaganda_list);
    }
    /**
     * Retorna uma propaganda de um anunciante
     *
     * @param Integer $index "O indice de uma propaganda"
     * @return Propaganda
     */
    public function getPropaganda($index) {
        $p = new Propaganda();
        $p->carregarPorID($this->propaganda_list[$index]);
        return $p;
    }
    /**
     * Seta uma propaganda de um anunciante
     *
     * @param Integer $index "O indice de uma propaganda"
     * @param Propaganda $object_propaganda "Um objeto propaganda"
     */
    public function setPropaganda($index, $object_propaganda) {
        $this->propaganda_list[$index]= $object_propaganda->id;
    }
    /**
     * Exclui o anunciante e todas as suas propagandas.
     * <br>
     * <b>Nota:</b> O objeto não será mais válido.
     *
     */
    public function excluir() {
        if (count($this->propaganda_list)>0) {
            foreach ($this->propaganda_list as $pid) {
                $p = new Propaganda();
                $p->carregarPorID($pid);
                $p->excluir();
            }
        }
        //$this->excluirRelacionamentos("Propaganda"); //não funciona isoladamente, pois a tabela tem chave estrangeira
        parent::excluir();
    }
    /**
     * Carrega os relacionamentos
     */
    protected function carregarRelacionamentos() {

        $this->propaganda_list = $this->carregarListaOneToMany(new Propaganda(), "");
    }
    /**
     * Salva os relacionamentos (exceto OneToMany)
     */
    protected function salvarRelacionamentos() {

    }
    /**
     * Retorna a quantidade de anunciantes
     * @return int
     */
    public static function count() {
        return parent::countTotal(new Anunciante());
    }

}
?>
