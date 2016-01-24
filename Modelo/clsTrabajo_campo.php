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
        $this->sen_tca = $sen_tca;
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
	
	
	public function listar($letra){
		$objDatos= new clsDatos();
		$sql = "select  
				persona.ced_per, CONCAT (persona.pno_per,' ', persona.sno_per,' ',persona.apa_per,' ',persona.ama_per) AS NOMBRE, 
				paciente.fre_pac,paciente.oex_pac,paciente.cas_pac, enfemedad.nom_enf,enfemedad.pri_enf,
				trabajo_campo.id_tca, trabajo_campo.npe_tca, trabajo_campo.tcr_tca, trabajo_campo.sen_tca, trabajo_campo.obs_tca, 	trabajo_campo.maq_tca, trabajo_campo.qui_tca, trabajo_campo.cqu_tca, trabajo_campo.cte_tca,trabajo_campo.est_tca, trabajo_campo.img_tca
	
				from 
					persona,paciente,trabajo_campo, ficha_paciente,enfemedad,paciente_enfermedad
				where 
					persona.id_per = paciente.id_per and trabajo_campo.id_tca = ficha_paciente.id_tca and paciente.id_pac = ficha_paciente.id_pac 
					and paciente.id_pac = paciente_enfermedad.id_pac and enfemedad.id_enf = paciente_enfermedad.id_enf and
					(persona.pno_per LIKE '%$letra%' OR persona.sno_per LIKE '%$letra%' OR persona.apa_per LIKE '%$letra%' OR persona.ama_per LIKE '%$letra%')";
		$datos_desordenados = $objDatos->consulta($sql);
		while($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->arreglo [] = array("Cedula"=>$columna['ced_per'],
									  "Nombre"=>$columna['NOMBRE'],
									  "Fecha"=>$columna['fre_pac'],
									  "Lugar_Examen"=>$columna['oex_pac'],
									  "Caso"=>$columna['cas_pac'],
									  "Enfermedad"=>$columna['nom_enf'],
									  "Prioridad"=>$columna['pri_enf'],
									  "id_trabajo_campo"=>$columna['id_tca'],
									  "n_personas"=>$columna['npe_tca'],
									  "tipo_criadero"=>$columna['tcr_tca'],
									  "sector_endemico"=>$columna['sen_tca'],
									  "tipo_maquina"=>$columna['maq_tca'],
									  "tipo_quimico"=>$columna['qui_tca'],
									  "cantidad_quimico"=>$columna['cqu_tca'],
									  "criterio"=>$columna['cte_tca'],
									  "estado"=>$columna['est_tca'],
									  "ruta_imagen"=>$columna['img_tca'],
									  );
		}
		return($this->arreglo);			
	}

    //Función para buscar usuarios
    public function buscar($id) {
    	$objDatos= new clsDatos();
		$sql = "select  
				persona.ced_per, CONCAT (persona.pno_per,' ', persona.sno_per,' ',persona.apa_per,' ',persona.ama_per) AS NOMBRE, 
				paciente.fre_pac,paciente.oex_pac,paciente.cas_pac, enfemedad.nom_enf,enfemedad.pri_enf,
				trabajo_campo.id_tca, trabajo_campo.npe_tca, trabajo_campo.tcr_tca, trabajo_campo.sen_tca, trabajo_campo.obs_tca, 	trabajo_campo.maq_tca, trabajo_campo.qui_tca, trabajo_campo.cqu_tca, trabajo_campo.cte_tca,trabajo_campo.est_tca, trabajo_campo.img_tca
	
				from 
					persona,paciente,trabajo_campo, ficha_paciente,enfemedad,paciente_enfermedad
				where 
					persona.id_per = paciente.id_per and trabajo_campo.id_tca = ficha_paciente.id_tca and paciente.id_pac = ficha_paciente.id_pac 
					and paciente.id_pac = paciente_enfermedad.id_pac and enfemedad.id_enf = paciente_enfermedad.id_enf
					and trabajo_campo.id_tca = '$id'";
		$datos_desordenados = $objDatos->consulta($sql);
		while($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->arreglo [] = array("Cedula"=>$columna['ced_per'],
									  "Nombre"=>$columna['NOMBRE'],
									  "Fecha"=>$columna['fre_pac'],
									  "Lugar_Examen"=>$columna['oex_pac'],
									  "Caso"=>$columna['cas_pac'],
									  "Enfermedad"=>$columna['nom_enf'],
									  "Prioridad"=>$columna['pri_enf'],
									  "id_trabajo_campo"=>$columna['id_tca'],
									  "n_personas"=>$columna['npe_tca'],
									  "tipo_criadero"=>$columna['tcr_tca'],
									  "sector_endemico"=>$columna['sen_tca'],
									  "observacion"=>$columna['obs_tca'],
									  "tipo_maquina"=>$columna['maq_tca'],
									  "tipo_quimico"=>$columna['qui_tca'],
									  "cantidad_quimico"=>$columna['cqu_tca'],
									  "criterio"=>$columna['cte_tca'],
									  "estado"=>$columna['est_tca'],
									  "ruta_imagen"=>$columna['img_tca'],
									  );
		}
		return($this->arreglo);		
    }
	
	//Funcion que permite busccar el nombre del paciente dado el id del paciente
	  public function GetNameId($id) {
    	$objDatos= new clsDatos();
		$sql = "select  ced_per, CONCAT (persona.pno_per,' ', persona.sno_per,' ',persona.apa_per,' ',persona.ama_per) AS NombrePaciente
				from 
					persona,paciente
				where 
					persona.id_per = paciente.id_per and paciente.id_pac ='$id'";
		$datos_desordenados = $objDatos->consulta($sql);
		while($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->arreglo [] = array("Cedula"=>$columna['ced_per'],
									  "NombrePaciente"=>$columna['NombrePaciente'],
									  );
		}
		return($this->arreglo);		
    }
	
	
	
    //Insertar usuario
    public function insertar() {
		$id = "";
        $objDatos = new clsDatos();
        $sql = "INSERT INTO trabajo_campo(npe_tca, tcr_tca, sen_tca, obs_tca,
                maq_tca, qui_tca, cqu_tca, cte_tca, est_tca , img_tca)
                VALUES ('$this->npe_tca','$this->tcr_tca',
                        '$this->sen_tca','$this->obs_tca','$this->maq_tca',
                        '$this->qui_tca','$this->cqu_tca','$this->cte_tca',
                        '$this->est_tca','$this->img_tca');";
        $id = $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
		return($id);
    }

    //Modificar datos de usuario
    public function modificar($id_trabajo_campo) {
        $objDatos = new clsDatos();
        $sql = "UPDATE trabajo_campo SET id_tca = '$id_trabajo_campo',
                npe_tca = '$this->npe_tca', tcr_tca = '$this->tcr_tca', sen_tca = '$this->sen_tca',
                obs_tca = '$this->obs_tca', maq_tca = '$this->maq_tca', qui_tca = '$this->qui_tca',
                cqu_tca = '$this->cqu_tca', cte_tca = '$this->cte_tca', est_tca = '$this->est_tca',
				img_tca = '$this->img_tca'
                WHERE id_tca = '$id_trabajo_campo';";
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