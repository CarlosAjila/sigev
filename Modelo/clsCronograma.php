<?php

/*
  Tipo de archivo: clase
  Descripción: Clase Cronograma
  Desarrollado por: Carlos Ajila
  Fecha de elaboración: 13 de Enero de 2016
  Fecha de modificación: 13 de Enero de 2016
  Versión: 0.1
 */
require_once("clsDatos.php");

class clsCronograma {

//Declarando datos
    public $id_cro;
    public $fe1_cro;
    public $fe2_cro;
    public $fe3_cro;
    public $maq_cro;
    public $cqu_cro;
    public $bar_cro;
    public $est_cro;

    //Constructor
    public function __construct($id_cro, $fe1_cro, $fe2_cro,$fe3_cro, $maq_cro, $cqu_cro, $bar_cro, $est_cro) {
        $this->id_cro = $id_cro;
        $this->fe1_cro = $fe1_cro;
        $this->fe2_cro = $fe2_cro;
        $this->fe3_cro = $fe3_cro;
        $this->maq_cro = $maq_cro;
        $this->cqu_cro = $cqu_cro;
        $this->bar_cro = $bar_cro;
        $this->est_cro = $est_cro;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_cro() {
        return $this->id_cro;
    }

    function get_fe1_cro() {
        return $this->fe1_cro;
    }

    function get_fe2_cro() {
        return $this->fe2_cro;
    }

    function get_fe3_cro() {
        return $this->fe3_cro;
    }

    function get_maq_cro() {
        return $this->maq_cro;
    }

    function get_cqu_cro() {
        return $this->cqu_cro;
    }

    function get_bar_cro() {
        return $this->bar_cro;
    }

    function get_est_cro() {
        return $this->est_cro;
    }

    
    //Función para buscar un cronograma
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM cronograma WHERE id_cro='$this->id_cro'";
        $datos_desordenados = $objDatos->consulta($sql);  
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_cro = $columna['id_cro'];
            $this->fe1_cro = $columna['fe1_cro'];
            $this->fe2_cro = $columna['fe2_cro'];
            $this->fe3_cro = $columna['fe3_cro'];
            $this->maq_cro = $columna['maq_cro'];
            $this->cqu_cro = $columna['cqu_cro'];
            $this->bar_cro = $columna['bar_cro'];
            $this->est_cro = $columna['est_cro'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar cronograma
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO cronograma (id_cro, fe1_cro, fe2_cro, fe3_cro, maq_cro, cqu_cro, bar_cro, est_cro)
                VALUES ('$objDatos->id_cro','$objDatos->fe1_cro','$objDatos->fe2_cro','$objDatos->fe3_cro',
                        '$objDatos->maq_cro','$objDatos->cqu_cro','$objDatos->bar_cro','$objDatos->est_cro');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de cronograma
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE cronograma
                SET id_cro = '$objDatos->id_cro',
                  fe1_cro = '$objDatos->fe1_cro',
                  fe2_cro = '$objDatos->fe2_cro',
                  fe3_cro = '$objDatos->fe3_cro',
                  maq_cro = '$objDatos->maq_cro',
                  cqu_cro = '$objDatos->cqu_cro',
                  bar_cro = '$objDatos->bar_cro',
                  est_cro = '$objDatos->est_cro'";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a una cronograma
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "UPDATE cronograma SET(est_cro='I')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

}

?>