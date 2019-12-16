<?php

/**
 * ItemSite
 * Classe abstrata para ser herdada pelas principais classes do site.
 *
 *
 * @author Tiago
 */
abstract class ItemSite {
    protected $id;
    protected $ATRIBUTO;




    /**
     * Retorna o ID
     *
     * @return Integer
     */
    public function getID() {
        return $this->id;
    }
    /**
     * Retorna um array contendo todos os IDs referente a classe
     *
     * @return Array<Integer>
     */
    public abstract static function getListID();

    /**
     * Carrega os índices dos objetos relacionados para uso dos getters e setters
     *
     */
    protected abstract function carregarRelacionamentos();

    /**
     * Salva os índices dos objetos relacionados
     *
     */
    protected abstract function salvarRelacionamentos();

    /**
     * Carrega todos os atributos pelo ID
     *
     * @param Integer $id
     */
    public function carregarPorID($id) {
        $sid = "\"$id\"";
        $query = "SELECT * FROM " . get_class($this) . " WHERE id=$sid";
        $this->ATRIBUTO= bd::executeSqlParaArrayTitulada($query);
        if (is_null($this->ATRIBUTO['id'])) {
            throw new Exception("Erro ao carregar item ".get_class($this). ", id $id : Não encontrado.");
        }
        else {
            $this->id=$this->ATRIBUTO['id'];
        }
        $this->carregarRelacionamentos();
    }
    /**
     * Carrega todos os atributos do objeto,
     * passando o nome da coluna e o valor a ser encontrado
     *
     * @param String $atributo "O nome do atributo"
     * @param String $valor "O valor a ser localizado"
     */
    public function carregarPorValorAtributo($atributo, $valor) {
        $sid = "\"$valor\"";// else $sid = $id;
        $query = "SELECT * FROM " . get_class($this) . " WHERE $atributo=$sid";
        $this->ATRIBUTO= bd::executeSqlParaArrayTitulada($query);
        $this->id=$this->ATRIBUTO['id'];
        $this->carregarRelacionamentos();
    }
    /**
     * Carrega a lista do relacionamento do tipo "Muitos para Muitos"
     *
     * @param ItemSite $object_list "Um objeto qualquer que faz parte da lista"
     * @param String $tabela_relacionamento "Nome da tabela que faz referencias"
     * @param String $addParametros "Comandos em formato SQL para adicionar no fim da consulta SQL"
     * @return Array
     */
    protected function carregarListaManyToMany($object_list,$tabela_relacionamento,$addParametros) {
        $query = "SELECT id".get_class($object_list)." FROM ".$tabela_relacionamento." WHERE id".get_class($this)."=$this->id $addParametros";
        return bd::executeSqlParaArraySimples($query);
    }
    /**
     * Carrega a lista do relacionamento do tipo "Um para Muitos"
     *
     * @param ItemSite $object_list "Um objeto qualquer que faz parte da lista"
     * @param String $addParametros "Comandos em formato SQL para adicionar no fim da consulta SQL"
     * @return Array
     */
    protected function carregarListaOneToMany($object_list,$addParametros) {
        $query = "SELECT id FROM ".get_class($object_list)." WHERE id".get_class($this)."=$this->id $addParametros";
        return bd::executeSqlParaArraySimples($query);
    }
    protected static function countTotal($object) {
        $query = "select * from ".get_class($object);
        $res = bd::executeSql($query);
        //echo get_class($object).mysql_num_rows($res);
        return @mysql_num_rows($res);
    }
    /**
     * Salva todos os atributos para o banco de dados
     * <br>
     * <b>Nota:</b> Os relacionamentos um para muitos não são salvos.
     * 
     */
    public function salvar() {
        $x = 0;
        $numColumns = bd::showColunas(get_class($this), $result);
        while ($x < $numColumns) {
            $colname = mysql_fetch_row($result);
            //$col[$colname[0]] = $x;
            $listaColunas[$x]=$colname[0];
            $novosValores[$x]='"'.addslashes($this->ATRIBUTO[$colname[0]]).'"';
            $setValores[$x]= $colname[0].
                    '="'.
                    addslashes($this->ATRIBUTO[$colname[0]]).
                    '"';
            $x++;
        }

        if ($this->id==null) {
            array_shift($novosValores);
            array_shift($listaColunas);
            $valoresString = implode (",", $novosValores);
            $colunasString = implode(",", $listaColunas);
            $query =
                    "INSERT INTO ".get_class($this)." (".$colunasString.")
                 VALUES (" .$valoresString .")" ;

            bd::executeSql($query);
            $this->id = bd::max("id",get_class($this));
        }
        else {
            array_shift($setValores);
            $setString = implode(", ",$setValores);
            $query = "UPDATE ".get_class($this).
                    " SET ". $setString .
                    " WHERE id=$this->id";

            bd::executeSql($query);
        }
        $this->salvarRelacionamentos();

    }
    protected function salvarListaManyToMany($object_item,$tabela_relacionamento,$array_item) {
        $this->excluirRelacionamentos($tabela_relacionamento);
        if (count($array_item)>0) {
            $initQuery  =  "INSERT INTO $tabela_relacionamento(
                                    id".get_class($object_item).",
                                    id".get_class($this).")
                                        VALUES ";
            $i=0;
            foreach ($array_item as $a) {
                $novosValores[$i]='("'.$a.'",'.$this->id.')';
                $i++;
            }
            $novosValoresString = implode(",", $novosValores);
            bd::executeSql("$initQuery $novosValoresString ");
        }
    }
    protected function excluirRelacionamentos($tabela_relacionamento) {
        if ($this->id!=null) {
            $queryDelete = "DELETE FROM ".
                    $tabela_relacionamento .
                    " WHERE id".get_class($this)." = ".$this->id ;
            bd::executeSql($queryDelete);
        }
    }
    public function excluir() {
        $queryDelete = "DELETE FROM ".
                get_class($this) .
                " WHERE id=".$this->id ;
        bd::executeSql($queryDelete);

        unset($this);
    }


}
?>
