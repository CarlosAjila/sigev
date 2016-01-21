
<?php
require_once '../Modelo/enfemedad.modelo.php';
require_once '../Modelo/enfermedad.entidad.php';
//echo '000000000';
//$objenfermedad = new EnfermedadModel();
//echo '111111111111';
//$ar = $objenfermedad->c_listar_enfermedad();
//echo '222222222222';
////$arre = $objenfermedad->c_listar_enfermedad();
//echo $ar[0]['nom_enf'];

class EnfermedadController{
    private $enfermedad_model;
    public function __CONSTRUCT()
    {
        echo 'iiiiiiii';
        $this->$enfermedad_model = new EnfermedadModel();
    }
    public function Index()
    {
        echo 'ooooooo';
        $enfermedad = $this->enfermedad_model->c_listar_enfermedad();
        require_once '../Vista/Paciente/Registrar_paciente.php';
        
    }
    
}

?>