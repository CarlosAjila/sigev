<?php

/*
  Tipo de archivo: clase
  Descripción: Clase Ficha_paciente
  Desarrollado por: Carlos Ajila
  Fecha de elaboración: 13 de Enero de 2016
  Fecha de modificación: 13 de Enero de 2016
  Versión: 0.1
 */
require_once("clsDatos.php");

class clsFicha_paciente {

//Declarando datos
    public $id_fpa;
    public $id_pac;
    public $id_tca;
    public $est_fpa;
    //Constructor
    public function __construct($id_fpa, $id_pac, $id_tca, $est_fpa ) {
        $this->id_fpa = $id_fpa;
        $this->id_pac = $id_pac;
        $this->id_tca = $id_tca;
        $this->est_fpa = $est_fpa;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_fpa() {
        return $this->id_fpa;
    }

    function get_id_pac() {
        return $this->id_pac;
    }

    function get_id_tca() {
        return $this->id_tca;
    }

    function get_est_fpa() {
        return $this->est_fpa;
    }

    
    //Función para buscar un enfermedad
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM ficha_paciente WHERE id_fpa='$this->id_fpa'";
        $datos_desordenados = $objDatos->consulta($sql);
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_fpa = $columna['id_fpa'];
            $this->id_pac = $columna['id_pac'];
            $this->id_tca = $columna['id_tca'];
            $this->est_fpa = $columna['est_fpa'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar Enfermedad
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO ficha_paciente
                (id_fpa, id_pac, id_tca, est_fpa)
                VALUES ('$this->id_fpa',
                        '$this->id_pac',
                        '$this->id_tca',
                        '$this->est_fpa');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de cronograma
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE ficha_paciente
                SET id_fpa = '$this->id_fpa',
                  id_pac = '$this->id_pac',
                  id_tca = '$this->id_tca',
                  est_fpa = '$this->est_fpa';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

   // Dar de baja a una ficha_paciente
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "UPDATE ficha_paciente SET(est_fpa='I')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
}

?>