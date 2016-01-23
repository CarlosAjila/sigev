<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

function conectar_servidor() {
    $hostname_conexion = "localhost";
    $username_conexion = "root";
    $password_conexion = "";
    $conexion = mysqli_connect($hostname_conexion, $username_conexion, $password_conexion, "bd_sigev") or trigger_error(mysql_error(), E_USER_ERROR);
    return $conexion;
}

function ejecutar_sentencia($query) {
    $conectar = conectar_servidor();
    $rs_resultado = mysqli_query($conectar, $query);
    mysqli_close($conectar);
    return $rs_resultado;
}

if (isset($Cod_Per)) {
    echo 'fdfjlkgjdlfjlgkd000000000000000000000';
    $rs_localidades = ejecutar_sentencia(
            "SELECT per.id_per,per.id_loc,per.ced_per,per.pno_per,per.sno_per,
                        per.apa_per,per.ama_per,per.fna_per,per.te1_per,per.te2_per,
                        per.sex_per,per.est_per,pac.id_pac,pac.id_geo,pac.id_per,
                        pac.oex_pac,pac.fre_pac,pac.cas_pac,pac.dir_pac,pac.ref_pac,
                        pac.ofi_pac,pac.dof_pac,pac.emi_pac,pac.fat_pac,pac.fis_pac,
                        pac.est_pac 
                        FROM persona per INNER JOIN paciente pac ON per.id_per = pac.id_per 
                        INNER JOIN georeferenciacion geo ON geo.id_geo = pac.id_geo
                        WHERE per.id_per = '$Cod_Per'"); //Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
    $localidad = mysqli_fetch_assoc($rs_localidades);
}
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
                    data: 'id=' + id,
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
                <div id="lista" class="listado">
                </div>
            </section>
        </form>
       
        <div id="editar_paciente" title="Editar datos de paciente">
            <?php include("../../Vista/Paciente/Editar_paciente.php"); ?> 
<!--            <form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormModificarPaciente" id="FormRegistroPaciente" enctype="multipart/form-data">
                <input id="modificar_paciente" name="modificar_paciente" type="hidden" value="modificar_paciente"/>
                <table class="contenedor" border="1">
                    <tr>
                        <td><input type="text" name="txtcedula" id="txtcedula" placeholder="Número de cédula" class="cajatexto" value="<?php echo $localidad ["ced_per"] ?>"/></td>
                        <td><input type="text" name="txtfn" id="txtfn" placeholder="Fecha de nacimiento" class="cajatexto" readonly="readonly" value="<?php echo $localidad ["fna_per"] ?>"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtpnombre" id="txtpnombre" placeholder="Primer nombre" class="cajatexto" value="<?php echo $localidad ["pno_per"] ?>"/></td>
                        <td><input type="text" name="txtsnombre" id="txtsnombre" placeholder="Segundo nombre" class="cajatexto" value="<?php echo $localidad ["sno_per"] ?>"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtapaterno" id="txtapaterno" placeholder="Apellido paterno" class="cajatexto" value="<?php echo $localidad ["apa_per"] ?>"/></td>
                        <td><input type="text" name="txtamaterno" id="txtamaterno" placeholder="Apellido materno" class="cajatexto" value="<?php echo $localidad ["ama_per"] ?>"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtcel" id="txtcel" placeholder="Número de celular" class="cajatexto" value="<?php echo $localidad ["te1_per"] ?>"/></td>
                        <td><input type="text" name="txttel" id="txttel" placeholder="Número de teléfono" class="cajatexto" value="<?php echo $localidad ["te2_per"] ?>"/></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" name="txtemipac" id="txtemipac" placeholder="Email" class="email" value="<?php echo $localidad ["emi_pac"] ?>"/></td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" name="txtlocalidad" id="txtlocalidad" placeholder="Ingrese el nombre de su parroquia" class="cajatexto"/>
                            <input type="hidden" name="id_loc" id="id_loc" value="<?php echo $localidad ["id_loc"] ?>" />
                        </td>
                        <td>
                            <input type="radio" name="sex_per" id="sex_per" value="M">M
                                <input type="radio" name="sex_per" id="sex_per" value="F">F
                        </td>
                    </tr>

                    <tr>
                        <td><input type="text" name="txtexpac" id="txtexpac" placeholder="Lugar donde se realizó el Examen" class="cajatexto" value="<?php echo $localidad ["oex_pac"] ?>"/></td>
                        <td>
                            <div id="cbOpciones">
                            <select>
                                <option value="A">Presuntivos</option>
                                <option value="B">Confirmados</option>
                                </select>
                            </div>
                         </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtdirpac" id="txtdirpac" placeholder="Dirección Domicilio" class="cajatexto" value="<?php echo $localidad ["dir_pac"] ?>"/></td>
                        <td><input type="text" name="txtrefpac" id="txtrefpac" placeholder="Referencia Domicilio" class="cajatexto" value="<?php echo $localidad ["ref_pac"] ?>"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtofipac" id="txtofipac" placeholder="Ocupacion" class="cajatexto" value="<?php echo $localidad ["ofi_pac"] ?>"/></td>
                        <td><input type="text" name="txtdofpac" id="txtdofpac" placeholder="Direccion Trabajo" class="cajatexto" value="<?php echo $localidad ["dof_pac"] ?>"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txfatpac" id="txfatpac" placeholder="Fecha Antencion" class="cajatexto" readonly="readonly"value="<?php echo $localidad ["fat_pac"] ?>"/></td>
                        <td><input type="text" name="txfispac" id="txfispac" placeholder="Fecha inicio Sintomas" class="cajatexto" readonly="readonly" value="<?php echo $localidad ["fis_pac"] ?>"/></td></td>
                    </tr>
                        <input type="hidden" name="longitud" id="longitud" value="" />
                        <input type="hidden" name="latitud" id="latitud" value="" />
                        <input type="hidden" name="id_geo" id="id_geo" value="<?php echo $localidad ["id_geo"] ?>" />
                    <tr>
                        <td colspan="3"><input type="button" name="btmodificar" id="btmodificar" value="MODIFICAR"/></td>
                    </tr>
                </table>
            </form>-->
       
        </div>
    </body>
</html>