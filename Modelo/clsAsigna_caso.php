<?php

/*
  Tipo de archivo: clase
  Descripción: Clase clsAsigna_caso
  Desarrollado por: Carlos Ajia
  Fecha de elaboración: 13 de Enero de 2016
  Fecha de modificación: 13 de Enero de 2016
  Versión: 0.1
 */
require_once("clsDatos.php");

class clsAsigna_caso {

//Declarando datos
    public $id_aca;
    public $id_pac;
    public $id_usu;
    public $tip_aca;
    public $est_aca;

    //Constructor
    public function __construct($id_aca, $id_pac, $id_usu, $tip_aca, $est_aca) {
        $this->id_aca = $id_aca;
        $this->id_pac = $id_pac;
        $this->id_usu = $id_usu;
        $this->tip_aca = $tip_aca;
        $this->est_aca = $est_aca;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_aca() {
        return $this->id_aca;
    }

    function get_id_pac() {
        return $this->id_pac;
    }

    function get_id_usu() {
        return $this->id_usu;
    }

    function get_tip_aca() {
        return $this->tip_aca;
    }

    function get_est_aca() {
        return $this->est_aca;
    }
    
    //Función para buscar un asignan_caso
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM asigna_caso WHERE id_aca='$this->id_aca'";
        $datos_desordenados = $objDatos->consulta($sql);
        
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_aca = $columna['id_aca'];
            $this->id_pac = $columna['id_pac'];
            $this->id_usu = $columna['id_usu'];
            $this->tip_aca = $columna['tip_aca'];
            $this->est_aca = $columna['est_aca'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar ac_cronograma
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO bd_sigev.asigna_caso
                    (id_aca,
                     id_pac,
                     id_usu,
                     tip_aca,
                     est_aca)
                VALUES ('$this->id_aca',
                        '$this->id_pac',
                        '$this->id_usu',
                        '$this->tip_aca',
                        '$this->est_aca');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de asigna_caso
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE asigna_caso
                SET id_aca = '$this->id_aca',
                  id_pac = '$this->id_pac',
                  id_usu = '$this->id_usu',
                  tip_aca = '$this->tip_aca',
                  est_aca = '$this->est_aca';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a una persona
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "UPDATE asigna_caso SET(est_aca='I')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

}

?>