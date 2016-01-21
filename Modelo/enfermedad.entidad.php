<?php

class Enfermedad {

//Declarando datos
    public $id_enf;
    public $nom_enf;
    public $pri_enf;

    public function __GET($k) {
        return $this->$k;
    }

    public function __SET($k, $v) {
        return $this->$k = $v;
    }

}
?>