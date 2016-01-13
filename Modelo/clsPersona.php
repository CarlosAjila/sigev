<?php

require_once("clsDatos.php");

class clsPersona {

//Declarando datos
    public $id_per;
    public $id_loc;
    public $ced_per;
    public $pno_per;
    public $sno_per;
    public $apa_per;
    public $ama_per;
    public $fna_per;
    public $te1_per;
    public $te2_per;
    public $sex_per;
    public $est_per;

    //Constructor
    public function __construct($id_per, $id_loc, $ced_per, $pno_per, $sno_per, $apa_per, $ama_per, $fna_per, $te1_per, $te2_per, $sex_per, $est_per) {
        $this->id_per = $id_per;
        $this->id_loc = $id_loc;
        $this->ced_per = $ced_per;
        $this->pno_per = $pno_per;
        $this->sno_per = $sno_per;
        $this->apa_per = $apa_per;
        $this->ama_per = $ama_per;
        $this->fna_per = $fna_per;
        $this->te1_per = $te1_per;
        $this->te2_per = $te2_per;
        $this->sex_per = $sex_per;
        $this->est_per = $est_per;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_per() {
        return $this->id_per;
    }

    function get_id_loc() {
        return $this->id_loc;
    }

    function get_ced_per() {
        return $this->ced_per;
    }

    function get_pno_per() {
        return $this->pno_per;
    }

    function get_sno_per() {
        return $this->sno_per;
    }

    function get_apa_per() {
        return $this->apa_per;
    }

    function get_ama_per() {
        return $this->ama_per;
    }

    function get_fna_per() {
        return $this->fna_per;
    }

    function get_te1_per() {
        return $this->te1_per;
    }

    function get_te2_per() {
        return $this->te2_per;
    }

    function get_sex_per() {
        return $this->sex_per;
    }

    function get_est_per() {
        return $this->est_per;
    }

    //Función para buscar usuarios
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM persona WHERE id_per='$this->id_per'";
        $datos_desordenados = $objDatos->consulta($sql);
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_per = $columna['id_per'];
            $this->id_loc = $columna['id_loc'];
            $this->ced_per = $columna['ced_per'];
            $this->pno_per = $columna['pno_per'];
            $this->pno_per = $columna['pno_per'];
            $this->sno_per = $columna['sno_per'];
            $this->sno_per = $columna['sno_per'];
            $this->sno_per = $columna['sno_per'];
            $this->apa_per = $columna['apa_per'];
            $this->ama_per = $columna['ama_per'];
            $this->fna_per = $columna['fna_per'];
            $this->te1_per = $columna['te1_per'];
            $this->te2_per = $columna['te2_per'];
            $this->sex_per = $columna['sex_per'];
            $this->est_per = $columna['est_per'];
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
        $sql = "INSERT INTO persona (id_per,id_loc,ced_per,pno_per,sno_per,apa_per,ama_per,fna_per,
             te1_per,te2_per, sex_per, est_per)
        VALUES ('$this->id_per','$this->id_loc','$this->ced_per','$this->pno_per','$this->sno_per','$this->apa_per',
        '$this->ama_per','$this->fna_per','$this->te1_per','$this->te2_per','$this->sex_per','$this->est_per');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de usuario
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE persona
        SET id_per  = '$this->id_per',
          id_loc  = '$this->id_loc',
          ced_per  = '$this->ced_per',
          pno_per  = '$this->pno_per',
          sno_per  = '$this->sno_per',
          apa_per  = '$this->apa_per',
          ama_per  = '$this->ama_per',
          fna_per  = '$this->fna_per',
          te1_per  = '$this->te1_per',
          te2_per  = '$this->te2_per',
          sex_per  = '$this->sex_per',
          est_per  = '$this->est_per'
        WHERE id_per  = '$this->id_per';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
    //Dar de baja a usuario
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "DELETE FROM persona WHERE (id_per='$this->id_per')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
}
?>