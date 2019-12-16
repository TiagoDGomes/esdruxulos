<h2>Humor</h2>
<?php
    $huids = Humor::getListID();
    ?><ul><?php
    foreach($huids as $huid){
        $hm = new Humor();
        $hm->carregarPorID($huid);
        echo '<li>'.$hm->getNome() . " - ".
        $hm->getDescricao() . '</li>';
    }
    ?></ul><?php
?>
