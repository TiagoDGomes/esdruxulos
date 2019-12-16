<?php
$propagandaUsada = array();

class Propaganda extends ItemSite implements ItemContagem {
    public $humor_list;
    public function clearLists() {
        $this->humor_list=array();
    }
    public static function getListID() {
        $query = "SELECT id FROM ".get_class()." ORDER BY ID ASC";
        return bd::executeSqlParaArraySimples($query);
    }
    public function countHumor() {
        return count($this->humor_list);
    }
    public function getNome() {
        return $this->ATRIBUTO['nome'];
    }
    public function setNome($nome) {
        $this->ATRIBUTO['nome']=$nome;
    }
    public function getConteudo() {
        return $this->ATRIBUTO['conteudo'];
    }
    public function setConteudo($conteudo) {
        $this->ATRIBUTO['conteudo']=$conteudo;
    }
    public function getPreco() {
        return $this->ATRIBUTO['preco'];
    }
    public function setPreco($preco) {
        $this->ATRIBUTO['preco']=$preco;
    }

    public function getAnunciante() {
        $a= new Anunciante();
        $a->carregarPorID($this->ATRIBUTO['idAnunciante']);
        return $a;
    }
    public function setAnunciante ($object_anunciante) {
        $this->ATRIBUTO['idAnunciante']=$object_anunciante->id;
    }
    public function getHumor($index) {
        $p = new Humor();
        $p->carregarPorID($this->humor_list[$index]);
        return $p;
    }
    public function setHumor ($index,$object_humor) {
        $this->humor_list[$index]= $object_humor->id;
    }

    public static function count() {
        return parent::countTotal(new Propaganda());
    }
    public function salvar() {
        if (is_null($this->ATRIBUTO['idAnunciante'])) {
            throw new Exception("Anunciante não definido.");
        }else if (is_null($this->ATRIBUTO['conteudo'])) {
            throw new Exception("Conteudo vazio para propaganda.");
        }else {
            parent::salvar();
        }
    }
    public function excluir() {
        $this->excluirRelacionamentos("HumorPropaganda");
        parent::excluir();
    }

    protected function carregarRelacionamentos() {
        $this->humor_list = $this->carregarListaManyToMany(new Humor(), "HumorPropaganda","");

    }
    protected function salvarRelacionamentos() {
        $this->salvarListaManyToMany(new Humor(), "HumorPropaganda", $this->humor_list);

    }
    /**
     * @param Usuario $usuario
     * @return Propaganda
     */
    public static function getPropagandaAleatoria($usuario) {
        // Se o usuário tem lista de humor...
        if ($usuario->countHumor()>0) {
            while ($k = 1) {
                // Se depois de 10 tentativas de propaganda
                // não repetida não derem certo,
                // sair do loop para e pegar uma propaganda aleatória

                if ($i==10) {
                    $k=1; // Valor que vai sair do loop
                    $x = rand(0, $usuario->countHumor()-1);
                    $h = $usuario->getHumor($x);

                    // Se o número de propagandas de um humor for maior que zero..
                    if ($h->countPropaganda()>0) {
                        $p = self::getPropagandaAleatoriaNaoRepetidaPorHumor($h);
                        if ($p instanceof Propaganda) {
                            return $p;
                        }
                    }
                    else {
                        return self::getPropagandaGenerica();
                    }
                }
                else {

                    try {
                        $h=$usuario->getHumorMaisVisitado();
                        if ($h->countPropaganda()>0) {
                            $p = self::getPropagandaAleatoriaNaoRepetidaPorHumor($h);
                            if ($p instanceof Propaganda) {
                                return $p;
                            }
                        }
                    } catch (Exception $exc) {

                    }


                }
                $i++;
            }



        }else {
            return self::getPropagandaGenerica();
        }


    }
    public static function getPropagandaAleatoriaNaoRepetidaPorHumor($humor) {
        // Pegar um id de uma propaganda aleatória do humor
        global $propagandaUsada;
        $x = rand(0, $humor->countPropaganda()-1);

        if (!is_array($propagandaUsada)) {
            $propagandaUsada = array();
        }
        // Se a propaganda ainda nao foi exibida,
        // retornar a propaganda escolhida

        if (!array_search($humor->getPropaganda($x), $propagandaUsada)) {
            $propagandaUsada[count($propagandaUsada)]=$humor->getPropaganda($x)->getID();
            return $humor->getPropaganda($x);
        }
    }
    public static function getPropagandaGenerica() {
        global $propagandaUsada;
        $p = new Propaganda();
        $ps = Propaganda::getListID();
        $c = count($ps);
//        if ($c>0) {
//            for ($i=0;$i<count($propagandaUsada);$i++) {
//                if (!array_search($propagandaUsada[$i],$ps)){
//                    $p->carregarPorID($ps[$propagandaUsada[$i]]);
//                }
//            }
//            if (!$p instanceof Propaganda) {
                $x = rand(0,$c-1);
                $p->carregarPorID($ps[$x]);
//            }
//        }

        //echo '<br>generica:';
        return $p;

    }

}
?>
