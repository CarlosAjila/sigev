<?php

/*
  Tipo de archivo: clase
  Descripción: Clase cargo
  Desarrollado por: Carlos Ajila
  Fecha de elaboración: 13 de Enero de 2016
  Fecha de modificación: 13 de Enero de 2016
  Versión: 0.1
 */
require_once("clsDatos.php");

class clsCargo {

//Declarando datos
    public $id_car;
    public $nom_car;
    public $est_car;

    //Constructor
    public function __construct($id_car, $nom_car, $est_car) {
        $this->id_car = $id_car;
        $this->nom_car = $nom_car;
        $this->est_car = $est_car;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_car() {
        return $this->id_car;
    }

    function get_nom_car() {
        return $this->nom_car;
    }

    function get_est_car() {
        return $this->est_car;
    }

    //Función para buscar un usuario
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM cargo WHERE id_car='$this->id_car'";
        $datos_desordenados = $objDatos->consulta($sql);

        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_car = $columna['id_car'];
            $this->nom_car = $columna['nom_car'];
            $this->est_car = $columna['est_car'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar cargo
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO bd_sigev.cargo
                (id_car,
                 nom_car,
                 est_car)
                VALUES ('$this->id_car',
                        '$this->nom_car',
                        '$this->est_car');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de cargo
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE cargo
                SET id_car = '$this->id_car',
                  nom_car = '$this->nom_car',
                  est_car = '$this->est_car';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a una persona
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "UPDATE cargo SET(est_car='I')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

}

?>