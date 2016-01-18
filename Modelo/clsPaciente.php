<?php

require_once "clsDatos.php";

class clsPaciente extends clsDatos {

//Declarando datos

    public $id_geo;
    public $id_per;
    public $oex_pac;
    public $fre_pac;
    public $cas_pac;
    public $dir_pac;
    public $ref_pac;
    public $ofi_pac;
    public $dof_pac;
    public $emi_pac;
    public $fat_pac;
    public $fis_pac;
    public $est_pac;

//Constructor
    public function __construct($id_geo, $id_per, $oex_pac, $fre_pac, $cas_pac, $dir_pac, $ref_pac, $ofi_pac, $dof_pac, $emi_pac, $fat_pac, $fis_pac, $est_pac) {

        $this->id_geo = $id_geo;
        $this->id_per = $id_per;
        $this->oex_pac = $oex_pac;
        $this->fre_pac = $fre_pac;
        $this->cas_pac = $cas_pac;
        $this->dir_pac = $dir_pac;
        $this->ref_pac = $ref_pac;
        $this->ofi_pac = $ofi_pac;
        $this->dof_pac = $dof_pac;
        $this->emi_pac = $emi_pac;
        $this->fat_pac = $fat_pac;
        $this->fis_pac = $fis_pac;
        $this->est_pac = $est_pac;
    }

//Destructor
    public function __destruct() {
        
    }

//Getters
    public function get_id_geo() {
        return $this->id_geo;
    }

    public function get_id_per() {
        return $this->id_per;
    }

    public function get_oex_pac() {
        return $this->oex_pac;
    }

    public function get_fre_pac() {
        return $this->fre_pac;
    }

    public function get_cas_pac() {
        return $this->cas_pac;
    }

    public function get_dir_pac() {
        return $this->dir_pac;
    }

    public function get_ref_pac() {
        return $this->ref_pac;
    }

    public function get_ofi_pac() {
        return $this->ofi_pac;
    }

    public function get_dof_pac() {
        return $this->dof_pac;
    }

    public function get_emi_pac() {
        return $this->emi_pac;
    }

    public function get_fat_pac() {
        return $this->fat_pac;
    }

    public function get_fis_pac() {
        return $this->fis_pac;
    }

    public function get_est_pac() {
        return $this->est_pac;
    }


    //Función para buscar paciente

//Función para buscar usuarios

    public function buscar() {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM usuario WHERE id_pac='$this->id_pac'";
        $datos_desordenados = $objDatos->consulta($sql);

        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_pac = $columna['id_pac'];
            $this->id_geo = $columna['id_geo'];
            $this->id_per = $columna['id_per'];
            $this->oex_pac = $columna['oex_pac'];
            $this->fre_pac = $columna['fre_pac'];
            $this->cas_pac = $columna['cas_pac'];
            $this->dir_pac = $columna['dir_pac'];
            $this->ref_pac = $columna['ref_pac'];
            $this->ofi_pac = $columna['ofi_pac'];
            $this->dof_pac = $columna['dof_pac'];
            $this->emi_pac = $columna['emi_pac'];
            $this->fat_pac = $columna['fat_pac'];
            $this->fis_pac = $columna['fis_pac'];
            $this->est_pac = $columna['est_pac'];
            $this->est_usu = $columna['est_usu'];
            $encontro = true;
        }

//Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }
	
	  //Función para buscar paciente por codigo
    public function buscar_paciente_x_codigo($cod_paciente) {
        $encontro = false;
        $objDatos = new clsDatos();
        $sql = "SELECT * FROM usuario WHERE id_pac='$cod_paciente'";
        $datos_desordenados = $objDatos->consulta($sql);


        if ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->id_pac = $columna['id_pac'];
            $this->id_geo = $columna['id_geo'];
            $this->id_per = $columna['id_per'];
            $this->oex_pac = $columna['oex_pac'];
            $this->fre_pac = $columna['fre_pac'];
            $this->cas_pac = $columna['cas_pac'];
            $this->dir_pac = $columna['dir_pac'];
            $this->ref_pac = $columna['ref_pac'];
            $this->ofi_pac = $columna['ofi_pac'];
            $this->dof_pac = $columna['dof_pac'];
            $this->emi_pac = $columna['emi_pac'];
            $this->fat_pac = $columna['fat_pac'];
            $this->fis_pac = $columna['fis_pac'];
            $this->est_pac = $columna['est_pac'];
            $this->est_usu = $columna['est_usu'];
            $encontro = true;
        }

        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
        return $encontro;
    }
	
    //Insertar Paciente

//Insertar Paciente

    public function insertar() {
        $objDatos = new clsDatos();
        $sql = "INSERT INTO paciente (id_geo, id_per, oex_pac, fre_pac, cas_pac, 
                dir_pac, ref_pac, ofi_pac, dof_pac, emi_pac, fat_pac, fis_pac, est_pac)
                VALUES ('$this->id_geo',
                        '$this->id_per',
                        '$this->oex_pac',
                        '$this->fre_pac',
                        '$this->cas_pac',
                        '$this->dir_pac',
                        '$this->ref_pac',
                        '$this->ofi_pac',
                        '$this->dof_pac',
                        '$this->emi_pac',
                        '$this->fat_pac',
                        '$this->fis_pac',
                        '$this->est_pac');";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

//Modificar datos de Paciente
    public function modificar() {
        $objDatos = new clsDatos();
        $sql = "UPDATE paciente
			SET id_geo = '$this->id_geo',
			  id_per = '$this->id_per',
			  oex_pac = '$this->oex_pac',
			  fre_pac = '$this->fre_pac',
			  cas_pac = '$this->cas_pac',
			  dir_pac = '$this->dir_pac',
			  ref_pac = '$this->ref_pac',
			  ofi_pac = '$this->ofi_pac',
			  dof_pac = '$this->dof_pac',
			  emi_pac = '$this->emi_pac',
			  fat_pac = '$this->fat_pac',
			  fis_pac = '$this->fis_pac',
			  est_pac = '$this->est_pac';";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

//Dar de baja a usuario
    //Dar de baja a un paciente
    public function dar_baja($id_per) {
        $objDatos = new clsDatos();
        $sql = "UPDATE paciente SET est_pac='I' WHERE id_per='$id_per'";
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }



//Listar personas
    /* Carlos Ajila */
    public function listar_persona_paciente($letra) {
        $objDatos = new clsDatos();
        //
        $sql = "SELECT per.id_per, per.ced_per, per.pno_per, per.sno_per, per.apa_per, per.ama_per, per.sex_per 
                FROM persona per 
                INNER JOIN paciente pac ON per.id_per = pac.id_per 
                INNER JOIN georeferenciacion geo ON geo.id_geo = pac.id_geo
                WHERE (pno_per LIKE '%$letra%' OR sno_per LIKE '%$letra%' OR apa_per LIKE '%$letra%' OR ama_per LIKE '%$letra%') 
                AND per.est_per='A'";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array(
                "id_per" => $columna['id_per'],
                "ced_per" => $columna['ced_per'],
                "nombre" => $columna['pno_per'] . " " . $columna['sno_per'],
                "apellido" => $columna['apa_per'] . " " . $columna['ama_per'],
                "sex_per" => $columna['sex_per']);
        }
        return($this->arreglo);
    }

    /* Jose Ambuludi */

    //Listar pacientes
    public function listar_paciente() {
        $objDatos = new clsDatos();
        $sql = "SELECT paciente.id_pac,georeferenciacion.lon_geo,georeferenciacion.lat_geo,persona.pno_per,persona.apa_per,enfemedad.nom_enf
FROM georeferenciacion,paciente,persona,enfemedad,paciente_enfermedad
WHERE paciente.id_per=persona.id_per AND paciente.id_geo=georeferenciacion.id_geo 
AND paciente.id_pac=paciente_enfermedad.id_pac AND paciente_enfermedad.id_enf=enfemedad.id_enf AND paciente.est_pac='A'";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array("paciente" => $columna['pno_per'] . ' ' . $columna['apa_per'],
                "enfermedad" => $columna['nom_enf'],
                "longitud" => $columna['lat_geo'],
                "latitud" => $columna['lon_geo'],
                "id_pac" => $columna['id_pac']);
        }
        return($this->arreglo);
    }

}

?>