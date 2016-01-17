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

class clsGeoreferenciacion {

//Declarando datos
    public $lat_geo;
    public $lon_geo;

    //Constructor
    public function __construct( $lat_geo, $lon_geo) {
        $this->lat_geo = $lat_geo;
        $this->lon_geo = $lon_geo;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_lat_geo() {
        return $this->lat_geo;
    }

    function get_lon_geo() {
        return $this->lon_geo;
    }

    //Función para buscar un georeferenciacion
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM georeferenciacion WHERE id_geo='$this->id_geo'";
        $datos_desordenados = $objDatos->consulta($sql);
      
        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_geo = $columna['id_geo'];
            $this->lat_geo = $columna['lat_geo'];
            $this->lon_geo = $columna['lon_geo'];
            $this->est_geo = $columna['est_geo'];
            $encontro = true;
        }
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar Georeferenciacion
    public function insertar($lat_geo,$lon_geo) {
        $id_geo="";
        $objDatos = new clsDatos();
        $sql = "INSERT INTO georeferenciacion (lat_geo, lon_geo) VALUES ('$lat_geo','$lon_geo')";
        $id_geo=$objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
        return $id_geo;
    }

    //Modificar datos de georeferenciacion
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE georeferenciacion
                SET id_geo = '$this->id_geo',
                  lat_geo = '$this->lat_geo',
                  lon_geo = '$this->lon_geo',
                  est_geo = '$this->est_geo';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

   // Dar de baja a una georeferenciacion
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "UPDATE georeferenciacion SET(est_geo='I')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
}

?>