<?php

require_once("clsDatos.php");

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
        $objDatos = new clsDatos();
        $sql = "SELECT per.id_per, per.ced_per, per.pno_per, per.sno_per, per.apa_per, per.ama_per, per.sex_per 
				FROM persona per, paciente
				where per.id_per = paciente.id_per and paciente.id_pac = '$cod_paciente' and paciente.est_pac = 'A'";

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
        //Cerrar la consulta
        $objDatos->cerrar_consulta($datos_desordenados);
        $objDatos->crerrarconexion();
    }

    //Insertar Paciente
//Insertar Paciente

    public function insertar() {
        $id = "";
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
        $id = $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
        return($id);
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

    //Listar pacientes-popup
    public function listar_paciente_popup() {
        $objDatos = new clsDatos();
        $sql = "SELECT paciente.id_pac,paciente.oex_pac,paciente.fre_pac,paciente.cas_pac,paciente.dir_pac,paciente.ref_pac,paciente.ofi_pac,
paciente.dof_pac,paciente.emi_pac,paciente.fat_pac,paciente.fis_pac,georeferenciacion.lon_geo,georeferenciacion.lat_geo,persona.pno_per,persona.apa_per,enfemedad.nom_enf
FROM georeferenciacion,paciente,persona,enfemedad,paciente_enfermedad
WHERE paciente.id_per=persona.id_per AND paciente.id_geo=georeferenciacion.id_geo 
AND paciente.id_pac=paciente_enfermedad.id_pac AND paciente_enfermedad.id_enf=enfemedad.id_enf AND paciente.est_pac='A'";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array("oex_pac" => $columna['oex_pac'],
                "fre_pac" => $columna['fre_pac'],
                "cas_pac" => $columna['cas_pac'],
                "dir_pac" => $columna['dir_pac'],
                "ref_pac" => $columna['ref_pac'],
                "lon_geo" => $columna['lon_geo'],
                "lat_geo" => $columna['lat_geo']);
        }
        return($this->arreglo);
    }
	
	 //Funcion para listar los pacientes que aun no han sido asignados a visitadores
    public function listar_paciente_asignar_vigilante() {
        $objDatos = new clsDatos();
        $sql = "SELECT paciente.id_pac,persona.pno_per,persona.apa_per,enfemedad.nom_enf
FROM paciente,persona,enfemedad,paciente_enfermedad
WHERE paciente.id_per=persona.id_per AND paciente.id_pac=paciente_enfermedad.id_pac 
AND paciente_enfermedad.id_enf=enfemedad.id_enf AND paciente.est_pac='A' 
AND paciente.id_pac NOT IN (SELECT asigna_caso.id_pac FROM asigna_caso)";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array("paciente" => $columna['pno_per'] . ' ' . $columna['apa_per'],
                "enfermedad" => $columna['nom_enf'],
                "id_pac" => $columna['id_pac']);
        }
        return($this->arreglo);
    }
	
	 //Funcion para presentar los casos que ya han sido asignados a un visitador
    public function lista_casoos_x_visitador($id_usu) {
        $objDatos = new clsDatos();
        $sql = "SELECT paciente.id_pac,persona.pno_per,persona.sno_per,persona.apa_per,persona.ama_per,enfemedad.nom_enf,localizacion.nom_loc,georeferenciacion.lat_geo,georeferenciacion.lon_geo
FROM paciente,persona,enfemedad,paciente_enfermedad,localizacion,georeferenciacion
WHERE paciente.id_per=persona.id_per AND paciente.id_pac=paciente_enfermedad.id_pac 
AND paciente_enfermedad.id_enf=enfemedad.id_enf AND paciente.est_pac='A' AND persona.id_loc=localizacion.id_loc AND paciente.id_geo=georeferenciacion.id_geo
AND paciente.id_pac IN (SELECT id_pac FROM asigna_caso WHERE asigna_caso.id_usu='$id_usu')";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array("paciente" => $columna['pno_per'] . ' ' .$columna['sno_per'] . ' ' .$columna['apa_per'] . ' ' . $columna['ama_per'],
                "enfermedad" => $columna['nom_enf'],
				"sector" => $columna['nom_loc'],
				"longitud" => $columna['lat_geo'],
				"latitud" => $columna['lon_geo'],
                "id_pac" => $columna['id_pac']);
        }
        return($this->arreglo);
    }

    //    METODOS CARLOS AJILA
    //Modificar datos de persona
    public function c_modificar_paciente( 
            $id_pac,$oex_pac, $cas_pac, $dir_pac, $ref_pac, $ofi_pac, $dof_pac, $emi_pac, $fat_pac, $fis_pac) {
        $objDatos = new clsDatos();
        $sql = "UPDATE paciente
			SET 
			  oex_pac = '$oex_pac',
			  cas_pac = '$cas_pac',
			  dir_pac = '$dir_pac',
			  ref_pac = '$ref_pac',
			  ofi_pac = '$ofi_pac',
			  dof_pac = '$dof_pac',
			  emi_pac = '$emi_pac',
			  fat_pac = '$fat_pac',
			  fis_pac = '$fis_pac' 
                          WHERE id_pac='$id_pac';";
        echo $sql;
        $objDatos->ejecutar($sql);
        $objDatos->crerrarconexion();
    }

    //incidencias de casos
    public function c_incidencias_por_fecha($fechaDesde, $fechaHasta) {
        $objDatos = new clsDatos();
        $sql = "SELECT per.ced_per, per.pno_per, per.sno_per, per.apa_per, per.ama_per,
                 enf.nom_enf, enf.pri_enf, pac.fre_pac
                FROM persona per 
                INNER JOIN paciente pac ON per.id_per = pac.id_per 
                INNER JOIN paciente_enfermedad pae ON pae.id_pac = pac.id_pac
                INNER JOIN enfemedad enf ON enf.id_enf = pae.id_enf 
                WHERE pac.fre_pac >= '$fechaDesde' AND pac.fre_pac <= '$fechaHasta'";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array(
                "cedula" => $columna['ced_per'],
                "nombre" => $columna['pno_per'] . " " . $columna['sno_per'],
                "apellido" => $columna['apa_per'] . " " . $columna['ama_per'],
                "enfermedad" => $columna['nom_enf'],
                "prioridad" => $columna['pri_enf'],
                "fechaRegistro" => $columna['fre_pac']);
        }
        $objDatos->crerrarconexion();
        return($this->arreglo);
    }

    //Reporte de lista de casos preuntivos o Confirmado
    public function c_lista_casos_paciente($casoPaciente) {
        if ($casoPaciente == "Todos") {
            $sqlWhere = "";
        }else{
            $sqlWhere = " WHERE pac.cas_pac = '$casoPaciente'";
        }
        $objDatos = new clsDatos();
        $sql = "SELECT per.ced_per, per.pno_per, per.sno_per, per.apa_per, per.ama_per, enf.nom_enf, enf.pri_enf, pac.fre_pac, pac.cas_pac
        FROM persona per 
        INNER JOIN paciente pac ON per.id_per = pac.id_per 
        INNER JOIN paciente_enfermedad pae ON pae.id_pac = pac.id_pac 
        INNER JOIN enfemedad enf ON enf.id_enf = pae.id_enf $sqlWhere";
        $datos_desordenados = $objDatos->consulta($sql);
        while ($columna = $objDatos->arreglos($datos_desordenados)) {
            $this->arreglo [] = array(
                "cedula" => $columna['ced_per'],
                "nombre" => $columna['pno_per'] . " " . $columna['sno_per'],
                "apellido" => $columna['apa_per'] . " " . $columna['ama_per'],
                "enfermedad" => $columna['nom_enf'],
                "prioridad" => $columna['pri_enf'],
                "fechaRegistro" => $columna['fre_pac'],
                "caso" => $columna['cas_pac']);
        }
        $objDatos->crerrarconexion();
        return($this->arreglo);
    }

}

?>