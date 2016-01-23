<?php

require_once("clsDatos.php");

class clsSintoma_paciente {

//Declarando datos
    public $id_spa;
    public $id_pae;
    public $id_sin;
    public $est_spa;

    //Constructor
    public function __construct($id_spa, $id_pae, $id_sin, $est_spa) {
        $this->id_spa = $id_spa;
        $this->id_pae = $id_pae;
        $this->id_sin = $id_sin;
        $this->est_spa = $est_spa;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_spa() {
        return $this->id_spa;
    }

    function get_id_pae() {
        return $this->id_pae;
    }

    function get_id_sin() {
        return $this->id_sin;
    }

    function get_est_spa() {
        return $this->est_spa;
    }

    
    //Función para buscar usuarios
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        /*
             public $id_spa;
    public ;
    public ;
    public ;
         */
        $sql = "SELECT * FROM sintomas_paciente WHERE id_spa='$this->id_spa'";
        $datos_desordenados = $objDatos->consulta($sql);

        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_spa = $columna['id_spa'];
            $this->id_pae = $columna['id_pae'];
            $this->id_sin = $columna['id_sin'];
            $this->est_spa = $columna['est_spa'];
            $encontro = true;
        }

        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar usuario
    public function insertar($id_pae, $id_sin) {
        $objDatos = new clsDatos();
        $sql = "insert into sintoma_paciente(id_pae,id_sin,est_spa)
                values ('$id_pae','$id_sin','A');";
        $id = $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
        return($id);
    }
      public function insertarm($id_loc, $ced_per, $pno_per, $sno_per, $apa_per, $ama_per, $fna_per, $te1_per, $te2_per, $sex_per) {
        $id = "";
        $objDatos = new clsDatos();
        $sql = "INSERT INTO persona(id_loc,ced_per,pno_per,sno_per,apa_per,ama_per,fna_per,te1_per,te2_per,sex_per) VALUES('$id_loc','$ced_per','$pno_per','$sno_per','$apa_per','$ama_per','$fna_per','$te1_per','$te2_per','$sex_per')";
        $id = $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
        return($id);
    }

    //Modificar datos de usuario
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE sintoma_paciente SET id_spa = '$this->id_spa',
                id_pae = '$this->id_pae', id_sin = '$this->id_sin', est_spa = '$this->est_spa'
                WHERE id_spa = '$this->id_spa';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a usuario
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "DELETE FROM sintoma_paciente WHERE (id_spa='$this->id_spa')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

}

?>