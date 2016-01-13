<?php

require_once("clsDatos.php");

class clsRepresentante {

//Declarando datos
    public $id_rep;
    public $ced_rep;
    public $pno_rep;
    public $sno_rep;
    public $app_rep;
    public $apm_rep;
    public $tel_rep;
    public $dit_rep;

    //Constructor
    public function __construct($id_rep, $ced_rep, $pno_rep, $sno_rep, $app_rep, $apm_rep, $tel_rep, $dit_rep) {
        $this->id_rep = $id_rep;
        $this->ced_rep = $ced_rep;
        $this->pno_rep = $pno_rep;
        $this->sno_rep = $sno_rep;
        $this->app_rep = $app_rep;
        $this->apm_rep = $apm_rep;
        $this->tel_rep = $tel_rep;
        $this->dit_rep = $dit_rep;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_rep() {
        return $this->id_rep;
    }

    function get_ced_rep() {
        return $this->ced_rep;
    }

    function get_pno_rep() {
        return $this->pno_rep;
    }

    function get_sno_rep() {
        return $this->sno_rep;
    }

    function get_app_rep() {
        return $this->app_rep;
    }

    function get_apm_rep() {
        return $this->apm_rep;
    }

    function get_tel_rep() {
        return $this->tel_rep;
    }

    function get_dit_rep() {
        return $this->dit_rep;
    }
    //Función para buscar usuarios
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM representante WHERE id_rep='$this->id_rep'";
        $datos_desordenados = $objDatos->consulta($sql);
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_rep = $columna['id_rep'];
            $this->ced_rep = $columna['ced_rep'];
            $this->pno_rep = $columna['pno_rep'];
            $this->sno_rep = $columna['sno_rep'];
            $this->app_rep = $columna['app_rep'];
            $this->apm_rep = $columna['apm_rep'];
            $this->tel_rep = $columna['tel_rep'];
            $this->dit_rep = $columna['dit_rep'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }
    //Insertar usuario
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO representante (id_rep, ced_rep, pno_rep, sno_rep, app_rep,apm_rep, tel_rep, dit_rep)
             VALUES ('$this->id_rep','$this->ced_rep','$this->pno_rep','$this->sno_rep',
        '$this->app_rep','$this->apm_rep','$this->tel_rep','$this->dit_rep');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
    //Modificar datos de usuario
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE representante SET id_rep = '$this->id_rep',ced_rep = '$this->ced_rep', pno_rep = '$this->pno_rep',
            sno_rep = '$this->sno_rep', app_rep = '$this->app_rep', apm_rep = '$this->apm_rep', tel_rep = '$this->tel_rep',
            dit_rep = '$this->dit_rep'
            WHERE id_rep = '$this->id_rep';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
    //Dar de baja a usuario
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "DELETE FROM representante WHERE (id_rep='$this->id_rep')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
}
?>