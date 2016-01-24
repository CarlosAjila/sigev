<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
// Todo esta lógica hara el papel de un FrontController
//if(!isset($_REQUEST['c'])){
//    require_once '../../Contralador/enfermedad.controller.php';
//    $controller = new EnfermedadController();
//    $controller->Index();    
//}
//else
//{
//    // Obtenemos el controlador que queremos cargar
//    $controller = $_REQUEST['c'] . 'Controller';
//    $accion     = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
//
//    // Instanciamos el controlador
//    require_once 'controller/' . strtolower($_REQUEST['c']) . '.controller.php';
//    $controller = new $controller();
//    
//    // Llama la accion
//    call_user_func( array( $controller, $accion ) );
//}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
        <link rel="stylesheet" type="text/css" href="../../Estilos/EstiloListarUsuario.css" />
        <link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="../../Estilos/fontello.css" />
        <script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
        <script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="../../AjaxUpload.2.0.min.js"></script>

        <title>SIGEV - Listar Pacientes</title>
        <script language="javascript">
            $(document).ready(function () {
                $('#txtbuscar').keyup(function () {
                    var value = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: '../../Contralador/listar_paciente.php',
                        data: 'dato=' + value,
                        success: function (datos) {
                            $('#lista').html(datos);
                        }
                    })
                }).keyup();
            });
        </script>
        <script language="javascript">

            function eliminarPaciente(id) {
                var buscar = $('#txtbuscar').val();
                var pregunta = confirm('¿Esta seguro de eliminar este Paciente?');
                if (pregunta == true) {
                    $.ajax({
                        type: 'POST',
                        url: '../../Contralador/Celiminar_paciente.php',
                        data: 'id=' + id + '&dato=' + buscar,
                        success: function (registro) {
                            $('#lista').html(registro);
                            return false;
                        }
                    });
                    //return false;
                }
            }



            function c_modificarPaciente(id) {
                
                $('#id_per').val(id);
                
                $.ajax({
                        type: 'POST',
                        url: 'Editar_paciente.php',
                        data: 'id=' + id ,
                        success: function (modificar) {
                            $('#editar_paciente').html(modificar);
                            return false;
                        }
                    });
                
                $('#editar_paciente').dialog('open');
            }

        </script>
        <script language="javascript">
            $(document).ready(function (e) {
                $('#editar_paciente').dialog({
                    autoOpen: false,
                    modal: true,
                    width: 470,
                    height: 450
                })
            })
        </script>
    </head>

    <body>
        <form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="form91" id="form91">
            <header>
                <div id="conte" class="contenedor">


                    <h1><img src="../../imagenes/lbanner-05.png" class="logo" /></h1>
                    <input type="checkbox" id="menu-bar" />
                    <label class="icon-menu" for="menu-bar"></label>
                    <nav class="menu">
                        <a href="../Estadistica/Inicio.php" style="font-size:18px;" class="icon-inicio">Inicio</a>
                    </nav>
                </div>
            </header>
            <section class="cuerpo">
                <table width="100%" class="tabla">
                    <tr>
                        <td>Ingrese Nombre o Apellido para iniciar la búsqueda</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="txtbuscar" id="txtbuscar" placeholder="Ingrese índice de búsqueda" class="txtbuscar"/>
                        </td>
                    </tr>
                </table>
                <div id="lista" class="listado"></div>
            </section>
        </form>
        <div id="editar_paciente" title="Editar datos de paciente">
            <?php include("../../Vista/Paciente/Editar_paciente.php"); ?>
        </div>
    </body>
</html>