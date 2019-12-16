<?php

class Usuario extends ItemSite implements ItemContagem {
    private $comentario_list;
    private $humor_list;
   public static function getListID($addParam = "ORDER BY ID ASC" ) {
        $query = "SELECT id FROM ".get_class()." ". $addParam;
        return bd::executeSqlParaArraySimples($query);
    }
    public function getNome() {
        return $this->ATRIBUTO['nome'];
    }

    public function setNome($nome) {
        $this->ATRIBUTO['nome'] = $nome;
    }

    public function getEndereco() {
        return $this->ATRIBUTO['endereco'];
    }

    public function setEndereco($endereco) {
        $this->ATRIBUTO['endereco'] = $endereco;
    }
    public function getBairro() {
        return $this->ATRIBUTO['bairro'];
    }

    public function setBairro($bairro) {
        $this->ATRIBUTO['bairro'] = $bairro;
    }

    public function getTelefone() {
        return $this->ATRIBUTO['telefone'];
    }

    public function setTelefone($telefone) {
        $this->ATRIBUTO['telefone'] = $telefone;
    }

    public function getCelular() {
        return $this->ATRIBUTO['celular'];
    }

    public function setCelular($celular) {
        $this->ATRIBUTO['celular'] = $celular;
    }

    public function getDataNascimento() {
        return $this->ATRIBUTO['dataNascimento'];
    }

    public function setDataNascimento($datanascimento) {
        $this->ATRIBUTO['dataNascimento'] = $datanascimento;
    }

    public function getLogin() {
        return $this->ATRIBUTO['login'];
    }
    public static function checkLoginNameExists($login){
        $result = bd::executeSqlParaArraySimples("SELECT id FROM Usuario WHERE login=\"$login\"");
        return $result[0];
    }
    public function setLogin($login) {
        $this->ATRIBUTO['login'] = $login;
    }
    public function getSexo() {
        return $this->ATRIBUTO['sexo'];
    }

    public function setSexo($sexo) {
        $this->ATRIBUTO['sexo'] = $sexo;
    }

    public function isSenhaValida($senha) {
        if (md5($senha)==$this->ATRIBUTO['senha'])
            return true;
        else
            return false;
    }
    public function getSenhaMD5Hash() {
        return $this->ATRIBUTO['senha'];
    }
    public function setSenha($senha) {
        $this->ATRIBUTO['senha'] = md5($senha);
    }

    public function getEmail() {
        return $this->ATRIBUTO['email'];
    }

    public function setEmail($email) {
        $this->ATRIBUTO['email'] = $email;
    }

    public function getCidade() {
        return $this->ATRIBUTO['cidade'];
    }

    public function setCidade($cidade) {
        $this->ATRIBUTO['cidade'] = $cidade;
    }
    public function getCookie() {
        return $this->ATRIBUTO['cookie'];
    }

    public function setCookie($cookie) {
        $this->ATRIBUTO['cookie'] = $cookie;
    }
    public function getSetorProfissional() {
        $s = new SetorProfissional();
        $s->carregarPorID($this->ATRIBUTO['idSetorProfissional']);
        return $s;
    }
    public function setSetorProfissional($object_setorProfissional) {
        $this->ATRIBUTO['idSetorProfissional']=$object_setorProfissional->id;
    }
    public function getUltimoIP() {
        return $this->ATRIBUTO['ultimoIP'];
    }
    public function getUltimoAcesso() {
        return $this->ATRIBUTO['ultimoAcesso'];
    }
    public function countHumor() {
        return count($this->humor_list);
    }
    public function countComentario() {
        return count($this->comentario_list);
    }
    public function getComentario($index) {
        $c = new Comentario();
        $c->carregarPorID($this->comentario_list[$index]);
        return $c;
    }
    public function getEstado() {
        $e = new Estado();
        $e->carregarPorID($this->ATRIBUTO['idEstado']);
        return $e;
    }/**
     *
     * @param Estado $estado
     */
    public function setEstado($estado) {
        $this->ATRIBUTO['idEstado']=$estado->getID();
    }

    /**
     *
     * @return Humor
     */
    public function getHumor($index) {
        $p = new Humor();
        $p->carregarPorID($this->humor_list[$index]);
        return $p;
    }
    /**
     * @param Humor $object_humor
     *
     */

    public function setNovoHumor($object_humor) {

        // <editor-fold defaultstate="collapsed" desc="Se o humor_list ainda não tem elementos, tem que definí-lo como array!">
        if (!is_array($this->humor_list)) {
            $this->humor_list= array();
        }// </editor-fold>
        // Se existe o ID na lista de humor...
        if (in_array($object_humor->getID(),$this->humor_list)) {
            // <editor-fold defaultstate="collapsed" desc="Descobrir a posicao do id do humor">
            $humorid=array_search($object_humor->getID(),$this->humor_list);
            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Setar o valor">
            $this->humor_list[$humorid]=$object_humor->id;
            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Adicionar mais um ao hit de visitas">
            $hits = $this->getNumeroDeVisitasPorHumor($object_humor) + 1;
            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Limpar informações do banco de dados">
            bd::executeSql('delete from usuariohumor where idUsuario='.$this->id.' and idHumor='.$object_humor->getID());
            // </editor-fold>
        }
        // Senão...
        else {
            // <editor-fold defaultstate="collapsed" desc="Pegar o maior indice da lista de humor para adicionar ao fim da lista de humor">
            $novoHumorID  = count($this->humor_list);
            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Setar o novo id de humor">
            $this->humor_list[$novoHumorID]=$object_humor->getID();// </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Definir o primeiro hit de visita">
            $hits=1;
            // </editor-fold>
        }
        // <editor-fold defaultstate="collapsed" desc="Salvar este hit para o banco de dados">
        bd::executeSql('insert into usuariohumor values ('.$this->id. ','.$object_humor->getID().','.$hits.')');
        // </editor-fold>

    }
    public function getNumeroDeVisitasPorHumor($humor) {
        $result= bd::executeSqlParaArraySimples('select numeroDeVisitas from usuariohumor where idUsuario='.$this->id.' and idHumor='.$humor->getID());
        return $result[0];
    }
    public function getIP() {
        return TCPIP::getClientIP();
    }
    protected function carregarRelacionamentos() {
        $this->comentario_list = $this->carregarListaOneToMany(new Comentario(), "ORDER BY dataPost DESC");
        $this->humor_list = $this->carregarListaManyToMany(new Humor(), "UsuarioHumor", "");

    }
    public function carregarPorCookie($cookie) {
        parent::carregarPorValorAtributo("cookie", $cookie);
        if ($this->id!=null) {
            $this->carregarPorID($this->id);
        }else throw new Exception("Cookie não existe");

    }
    public function carregarPorLoginSenha($login, $senha) {
        parent::carregarPorValorAtributo("login", $login);
        if ($this->id!=null) {
            $this->carregarPorID($this->id);
            if ($this->ATRIBUTO['senha']!=md5($senha)) {
                throw new Exception("Login ou senha inválida");
            }

        }else throw new Exception("Login ou senha inválida");

    }
    public static function count() {
        return parent::countTotal(new Usuario());
    }
    public function salvar() {
        //if ($this->ATRIBUTO['senha']=="")
        //    $this->ATRIBUTO['nome']=htmlentities($_SERVER["HTTP_USER_AGENT"]);
        if ($this->ATRIBUTO['idSetorProfissional']==null)
            $this->ATRIBUTO['idSetorProfissional']=1;
        if ($this->ATRIBUTO['idEstado']==null)
            $this->ATRIBUTO['idEstado']=1;
        $this->ATRIBUTO['ultimoAcesso'] = bd::now();
        $this->ATRIBUTO['ultimoIP'] = TCPIP::getClientIP();

        parent::salvar();

    }
    public function excluir() {
        $this->excluirRelacionamentos("usuariohumor");
        $this->excluirRelacionamentos("comentario");
        parent::excluir();
    }
    /**
     * Retorna o número de visitas do usuário no site
     * @return int
     */

    public function getNumeroDeVisitas() {
        return $this->ATRIBUTO['numeroDeVisitas'];
    }
    public function hitVisita() {
        $this->ATRIBUTO['numeroDeVisitas'] ++;
    }

    protected function salvarRelacionamentos() {
        //$this->salvarListaManyToMany(new Humor(), "usuariohumor", $this->humor_list);

    }
    public function  __toString() {
        return $this->getNome();
    }
    /**
     *
     * @param Historia $historia
     */
    public function navegaEmHistoria($historia) {
        //bd::executeSql('insert into LogDeNavegacao (idHistoria, idUsuario) values ('.$historia->getID().','.$this->getID().')');
        for ($i=0; $i< $historia->countHumor();$i++) {
            $this->setNovoHumor($historia->getHumor($i));
        }
    }
    /**
     * @return Humor
     */
    public function getHumorMaisVisitado() {
        //$result='SELECT * FROM Historia, Humor, LogDeNavegacao WHERE historia.id';
        $result = bd::executeSqlParaArrayTitulada('SELECT max(numerodevisitas),idhumor FROM usuariohumor where idUsuario='.$this->getID());
        $h = new Humor();
        try {
            $h->carregarPorID($result['idHumor']);

        } catch (Exception $exc) {
            throw  new Exception('Usuario não tem um humor mais visitado.');

        }
        return $h;
    }


}
?>
