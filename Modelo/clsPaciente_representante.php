<?php

require_once("clsDatos.php");

class clsPaciente_representante {

//Declarando datos

    public $id_pre;
    public $id_pac;
    public $id_rep;
    public $est_pre;

    //Constructor
    public function __construct($id_pre, $id_pac, $id_rep, $est_pre) {
        $this->id_pre = $id_pre;
        $this->id_pac = $id_pac;
        $this->id_rep = $id_rep;
        $this->est_pre = $est_pre;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_pre() {
        return $this->id_pre;
    }

    function get_id_pac() {
        return $this->id_pac;
    }

    function get_id_rep() {
        return $this->id_rep;
    }

    function get_est_pre() {
        return $this->est_pre;
    }

    //Función para buscar usuarios
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM paciente_representante WHERE $id_pre='$this->id_pre'";
        $datos_desordenados = $objDatos->consulta($sql);
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_pre = $columna['id_pre'];
            $this->id_pac = $columna['id_pac'];
            $this->id_rep = $columna['id_rep'];
            $this->est_pre = $columna['est_pre'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar paciente_enfermedad
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO paciente_representante (id_pre, id_pac, id_rep, est_pre)
                VALUES ('$this->id_pre', '$this->id_pac', '$this->id_rep','$this->est_pre');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de paciente_representante
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE paciente_representante
                SET id_pre = '$this->id_pre',
                  id_pac = '$this->id_pac',
                  id_rep = '$this->id_rep',
                  est_pre = '$this->est_pre'
                WHERE id_pre = '$this->id_pre';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a paciente_representante
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "DELETE FROM paciente_representante WHERE (id_pre='$this->id_pre')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

}

?>