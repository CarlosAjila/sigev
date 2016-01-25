<?php

require_once("clsDatos.php");

class clsPaciente_enfermedad {

//Declarando datos
    public $id_pac;
    public $id_enf;
    public $est_pae;

    //Constructor
    public function __construct($id_pac, $id_enf, $est_pae) {
        $this->id_pac = $id_pac;
        $this->id_enf = $id_enf;
        $this->est_pae = $est_pae;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_pae() {
        return $this->id_pae;
    }

    function get_id_pac() {
        return $this->id_pac;
    }

    function get_id_enf() {
        return $this->id_enf;
    }

    function get_est_pae() {
        return $this->est_pae;
    }

    //Función para buscar usuarios
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM paciente_enfermedad WHERE $id_pac='$this->id_geo'";
        $datos_desordenados = $objDatos->consulta($sql);
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_pae = $columna['id_pae'];
            $this->id_pac = $columna['id_pac'];
            $this->id_enf = $columna['id_enf'];
            $this->est_pae = $columna['est_pae'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar paciente_enfermedad
    public function insertar() {
        $id = "";
        $objDatos = new clsDatos();
        $sql = "INSERT INTO paciente_enfermedad(id_pae,id_pac,id_enf,est_pae)
                VALUES ('$this->id_pae','$this->id_pac','$this->id_enf','$this->est_pae');";
        $id = $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
        return($id);
    }

    //Modificar datos de usuario
    public function c_modificar_enfermedad_paciente($id_pae,$id_enf) {
        $objDatos = new clsDatos();
        $sql = "update paciente_enfermedad
                set id_enf '$id_enf',
                where id_pae '$id_pae';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
    
  

    //Dar de baja a usuario
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "DELETE FROM paciente_enfermedad WHERE (id_pae='$this->id_pae')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
}

?>