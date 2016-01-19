<?php

require_once("clsDatos.php");

class clsTrabajo_campo {

//Declarando datos
    public $id_tca;
    public $npe_tca;
    public $tcr_tca;
    public $sen_tca;
    public $obs_tca;
    public $maq_tca;
    public $qui_tca;
    public $cqu_tca;
    public $cte_tca;
    public $est_tca;
	public $img_tca;

    //Constructor ordinario
    public function __construct($npe_tca, $tcr_tca, $sen_tca, $obs_tca, $maq_tca, $qui_tca, $cqu_tca, $cte_tca, $est_tca, $img_tca) {
        
        $this->npe_tca = $npe_tca;
        $this->tcr_tca = $tcr_tca;
        $this->est_spa = $sen_tca;
        $this->obs_tca = $obs_tca;
        $this->maq_tca = $maq_tca;
        $this->qui_tca = $qui_tca;
        $this->cqu_tca = $cqu_tca;
        $this->cte_tca = $cte_tca;
        $this->est_tca = $est_tca;
		$this->img_tca = $img_tca;
    }

    //Destructor
    public function __destruct() {
        
    }
	
	//PROPIEDADES
    //Getters
    function get_id_tca() {
        return $this->id_tca;
    }

    function get_npe_tca() {
        return $this->npe_tca;
    }

    function get_tcr_tca() {
        return $this->tcr_tca;
    }

    function get_sen_tca() {
        return $this->sen_tca;
    }

    function get_obs_tca() {
        return $this->obs_tca;
    }

    function get_maq_tca() {
        return $this->maq_tca;
    }

    function get_qui_tca() {
        return $this->qui_tca;
    }

    function get_cqu_tca() {
        return $this->cqu_tca;
    }

    function get_cte_tca() {
        return $this->cte_tca;
    }

    function get_est_tca() {
        return $this->est_tca;
    }
	
	function get_img_tca() {
        return $this->img_tca;
    }

    //Función para buscar usuarios
    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM trabajo_campo WHERE id_tca='$this->id_tca'";
        $datos_desordenados = $objDatos->consulta($sql);

        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_tca = $columna['id_tca'];
            $this->npe_tca = $columna['npe_tca'];
            $this->tcr_tca = $columna['tcr_tca'];
            $this->sen_tca = $columna['sen_tca'];
            $this->maq_tca = $columna['maq_tca'];
            $this->qui_tca = $columna['qui_tca'];
            $this->cqu_tca = $columna['cqu_tca'];
            $this->cte_tca = $columna['cte_tca'];
            $this->est_tca = $columna['est_tca'];
			$this->img_tca = $columna['img_tca'];
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
        $sql = "INSERT INTO trabajo_campo(npe_tca, tcr_tca, sen_tca, obs_tca,
                maq_tca, qui_tca, cqu_tca, cte_tca, est_tca , img_tca)
                VALUES ('$this->npe_tca','$this->tcr_tca',
                        '$this->sen_tca','$this->obs_tca','$this->maq_tca',
                        '$this->qui_tca','$this->cqu_tca','$this->cte_tca',
                        '$this->est_tca','this->get_img_tca()');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Modificar datos de usuario
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE trabajo_campo SET id_tca = '$this->id_tca',
                npe_tca = '$this->npe_tca', tcr_tca = '$this->tcr_tca', sen_tca = '$this->sen_tca',
                obs_tca = '$this->obs_tca', maq_tca = '$this->maq_tca', qui_tca = '$this->qui_tca',
                cqu_tca = '$this->cqu_tca', cte_tca = '$this->cte_tca', est_tca = '$this->est_tca',
				img_tca = 'this->get_img_tca()'
                WHERE id_tca = '$this->id_tca';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //Dar de baja a usuario
    public function dar_baja() {
        $objDatos = new clsDatos();
        $sql = "DELETE FROM trabajo_campo WHERE (id_tca='$this->id_tca')";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }
}
?>