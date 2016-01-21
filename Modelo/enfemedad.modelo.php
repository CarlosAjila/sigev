<?php

/*
  Tipo de archivo: clase
  Descripción: Clase enfemedad
  Desarrollado por: Carlos Ajila
  Fecha de elaboración: 13 de Enero de 2016
  Fecha de modificación: 13 de Enero de 2016
  Versión: 0.1
 */
require_once("clsDatos.php");

class EnfermedadModel {

    //Constructor
    public function __construct($id_enf, $nom_enf, $pri_enf) {
        $this->id_enf = $id_enf;
        $this->nom_enf = $nom_enf;
        $this->pri_enf = $pri_enf;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters

    function get_id_enf() {
        return $this->id_enf;
    }

    function get_nom_enf() {
        return $this->nom_enf;
    }

    function get_pri_enf() {
        return $this->pri_enf;
    }

    //Función para buscar un enfermedad
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM enfemedad WHERE id_enf='$this->id_enf'";
        $datos_desordenados = $objDatos->consulta($sql);
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_enf = $columna['id_enf'];
            $this->nom_enf = $columna['nom_enf'];
            $this->pri_enf = $columna['pri_enf'];
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
        $sql = "INSERT INTO enfemedad (id_enf, nom_enf, pri_enf)
                VALUES ('$objDatos->id_enf', '$objDatos->nom_enf', '$objDatos->pri_enf');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de cronograma
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE enfemedad
                SET id_enf = '$objDatos->id_enf',
                  nom_enf = '$objDatos->nom_enf',
                  pri_enf = '$objDatos->pri_enf'";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a una cronograma
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "UPDATE enfemedad SET(id_enf='I')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //// metodos Carlos
    public function c_listar_enfermedad() {
        try {
            $result = array();
            $objDatos = new clsDatos();
            $sql = "SELECT * FROM enfemedad";
            $datos_desordenados = $objDatos->consulta($sql);
             while ($columna = $objDatos->arreglos($datos_desordenados)) {
                $result [] = array(
                    "id_enf" => $columna['id_enf'],
                    "nom_enf" => $columna['nom_enf'],
                    "pri_enf" => $columna['pri_enf']);
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

//    public function c_listar_enfermedad() {
//        try {
//            $objDatos = new clsDatos();
//            $sql = "SELECT * FROM enfemedad";
//            $datos_desordenados = $objDatos->consulta($sql);
//            while ($columna = $objDatos->arreglos($datos_desordenados)) {
//                $this->arreglo [] = array(
//                    "id_enf" => $columna['id_enf'],
//                    "nom_enf" => $columna['nom_enf'],
//                    "pri_enf" => $columna['pri_enf']);
//            }
//
//            return($this->arreglo);
//        } catch (Exception $e) {
//            die($e->getMessage());
//        }
////        while ($columna = $objDatos->arreglos($datos_desordenados)) {
////            $this->arreglo [] = array(
////                "id_enf" => $columna['id_enf'],
////                "nom_enf" => $columna['nom_enf'],
////                "pri_enf" => $columna['pri_enf']);
////        }
//        //return($this->arreglo);
//    }

    public function c_buscar_sintomas_enfermedad($id_enf) {
        $objDatos = new clsDatos();
        $sql = "SELECT s.id_sin,s.nom_sin
                FROM enfemedad e
                INNER JOIN enfermedad_sintoma e_s ON  e_s.id_enf = e.id_enf
                INNER JOIN sintoma s ON s.id_sin = e_s.id_sin 
                WHERE e.id_enf = '$id_enf';";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array(
                "id_sin" => $columna['id_sin'],
                "nom_sin" => $columna['nom_sin']);
        }
        return($this->arreglo);
    }

}

?>