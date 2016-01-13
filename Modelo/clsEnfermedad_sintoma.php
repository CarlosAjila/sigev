<?php

/*
  Tipo de archivo: clase
  Descripción: Clase enfemedad_Sintomas
  Desarrollado por: Carlos Ajila
  Fecha de elaboración: 13 de Enero de 2016
  Fecha de modificación: 13 de Enero de 2016
  Versión: 0.1
 */
require_once("clsDatos.php");

class clsEnfemedad {

//Declarando datos
    public $id_esi;
    public $id_enf;
    public $id_sin;

    //Constructor
    public function __construct($id_esi, $id_enf, $id_sin) {
        $this->id_esi = $id_esi;
        $this->id_enf = $id_enf;
        $this->id_sin = $id_sin;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_esi() {
        return $this->id_esi;
    }

    function get_id_enf() {
        return $this->id_enf;
    }

    function get_id_sin() {
        return $this->id_sin;
    }

    //Función para buscar un enfermedad
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM enfemedad_sintoma WHERE id_esi='$this->id_esi'";
        $datos_desordenados = $objDatos->consulta($sql);
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_esi = $columna['id_esi'];
            $this->id_enf = $columna['id_enf'];
            $this->id_sin = $columna['id_sin'];
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
        $sql = "INSERT INTO enfermedad_sintoma (id_esi, id_enf, id_sin)
            VALUES ('$this->id_esi', '$this->id_enf', '$this->id_sin');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de cronograma
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE enfermedad_sintoma
                SET id_esi = '$this->id_esi',
                  id_enf = '$this->id_enf',
                  id_sin = '$this->id_sin';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a una enfermedad_sintoma
//    public function dar_baja() {
//        $objDatos = new clsDatos();
//        $sql = "UPDATE enfermedad_sintoma SET(id_enf='I')";
//        $objDatos->ejecutar($sql);
//        $objDatos->crerrarconexion();
//    }
}

?>