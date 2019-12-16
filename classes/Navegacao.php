<?php

class Navegacao {
    /**
     *
     * @var Usuario
     */
    private $usuario;
    /**
     *
     * @var Historia
     */
    private $historia;
    function __construct($usuario, $historia) {
            $this->usuario = $usuario;
            $this->historia = $historia;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getHistoria() {
        return $this->historia;
    }

    public function setHistoria($historia) {
        $this->historia = $historia;
    }
    protected function salvar(){
        bd::executeSql('DELETE FROM Navegacao WHERE '.
                            ' idHistoria='.$this->historia->getID(). 
                            ' AND idUsuario='.$this->usuario->getID());
        bd::executeSql('INSERT INTO Navegacao VALUES ('.
                        $this->historia->getID().','.
                        $this->usuario->getID().','.
                        bd::now().    ')');
    }


}
?>
