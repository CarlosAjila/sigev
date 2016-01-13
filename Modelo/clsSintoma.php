<?php

require_once("clsDatos.php");

class clsSintoma {

//Declarando datos
    public $id_car;
    public $id_sin;
    public $nom_sin;
    public $est_sin;

    //Constructor
    public function __construct($id_car, $id_sin, $nom_sin, $est_sin) {
        $this->id_car = $id_car;
        $this->id_sin = $id_sin;
        $this->nom_sin = $nom_sin;
        $this->est_sin = $est_sin;
    }

    //Destructor
    public function __destruct() {
        
    }

    //Getters
    function get_id_car() {
        return $this->id_car;
    }

    function get_id_sin() {
        return $this->id_sin;
    }

    function get_nom_sin() {
        return $this->nom_sin;
    }

    function get_est_sin() {
        return $this->est_sin;
    }

    //Función para buscar usuarios
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM sintomas WHERE id_car='$this->id_car'";
        $datos_desordenados = $objDatos->consulta($sql);

        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_car = $columna['id_car'];
            $this->id_sin = $columna['id_sin'];
            $this->nom_sin = $columna['nom_sin'];
            $this->est_sin = $columna['est_sin'];
            $encontro = true;
        }

        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }

    //Insertar usuario
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO sintoma(id_sin, nom_sin,est_sin)
                VALUES ('$this->id_sin','$this->nom_sin','$this->est_sin');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de usuario
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "update sintoma
                set id_sin = '$this->id_sin',
                  nom_sin = '$this->nom_sin',
                  est_sin = '$this->est_sin'
                where id_sin = '$this->id_sin';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a usuario
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "DELETE FROM sintoma WHERE (id_sin='$this->id_sin')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

}

?>