<?php

require_once("clsDatos.php");

class clsFichaPaciente {

//Declarando datos
    public $id_ficha_paciente;
    public $id_paciente;
    public $id_trabajo_campo;
    public $estado;
	
 

	
	//Constructor ordinario 
	//inicializa los valores de las variables de la clase
    public function __construct($id_p,$id_tc,$est) {
        $this->id_paciente 		= $id_p;
        $this->id_trabajo_campo = $id_tc;
        $this->estado 			= $est;
    
    }

    //Destructor
    public function __destruct() {
        
    }
	
	//PROPIEDADES
    //Getters
    function get_id_ficha_paciente() {
        return $this->id_ficha_paciente;
    }

    function get_id_paciente() {
        return $this->id_paciente;
    }

    function get_id_trabajo_campo() {
        return $this->id_trabajo_campo;
    }

    function get_estado() {
        return $this->estado;
    }

   
    //Función para buscar usuarios
    public function buscar() {
       
    }

    //Insertar usuario
    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO ficha_paciente(id_pac, id_tca, est_fpa)
                VALUES ('$this->id_paciente','$this->id_trabajo_campo',
                        '$this->estado');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();		
    }

    //Modificar datos de usuario
    public function modificar() {
        /*$objDatos = new clsDatos();
        $sql = "UPDATE trabajo_campo SET id_tca = '$this->id_tca',
                npe_tca = '$this->npe_tca', tcr_tca = '$this->tcr_tca', sen_tca = '$this->sen_tca',
                obs_tca = '$this->obs_tca', maq_tca = '$this->maq_tca', qui_tca = '$this->qui_tca',
                cqu_tca = '$this->cqu_tca', cte_tca = '$this->cte_tca', est_tca = '$this->est_tca',
				img_tca = 'this->get_img_tca()'
                WHERE id_tca = '$this->id_tca';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();*/
    }

    //Dar de baja
    public function dar_baja() {
        /*$objDatos = new clsDatos();
        $sql = "DELETE FROM trabajo_campo WHERE (id_tca='$this->id_tca')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();*/
    }
}
?>