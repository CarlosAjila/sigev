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

        $id = $_POST['id'];
        $rs_localidades = ejecutar_sentencia(
                "SELECT per.id_per,
per.id_loc,
per.ced_per,
per.pno_per,
per.sno_per,
per.apa_per,
per.ama_per,
per.fna_per,
per.te1_per,
per.te2_per,
per.sex_per,
per.est_per,
pac.id_pac,
pac.id_geo,
pac.id_per,
pac.oex_pac,
pac.fre_pac,
pac.cas_pac,
pac.dir_pac,
pac.ref_pac,
pac.ofi_pac,
pac.dof_pac,
pac.emi_pac,
pac.fat_pac,
pac.fis_pac,
pac.est_pac
FROM persona per 
INNER JOIN paciente pac ON per.id_per = pac.id_per 
INNER JOIN georeferenciacion geo ON geo.id_geo = pac.id_geo
WHERE per.id_per = '105'"); //Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
//WHERE per.id_per = '".$id."'");//Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
        $localidad = mysqli_fetch_assoc($rs_localidades); //Mediante esta línea en la variable $localidad recibimos un arreglo con el resultado de la consulta
        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
        <link rel="stylesheet" type="text/css" href="../../Estilos/EstiloRegistrar.css" />
        <link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
        <script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
        <script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
        
        <title>SIGEV-Registro Cuenta Usuario</title>
        
        <script language="javascript">
            //Evento que se disparará cuando se vaya a cargar una foto de perfil
            $(function () {
                var btnUpload = $('#btimagen');
                var status = $('#status');
                new AjaxUpload(btnUpload, {
                    action: '../../Contralador/CargarFoto.php',
                    name: 'uploadfile',
                    dataType: 'json',
                    onSubmit: function (file) {
                        $('#load').attr('class', 'imagensi');
                        status.text('Cargando...');
                    },
                    onComplete: function (file, response) {
                        //Parseamos el array JSON
                        var respuesta = $.parseJSON(response);
                        alert(respuesta.mensaje);
                        status.text('');
                        $('#fotoPerfil').removeAttr('src');
                        $('#fotoPerfil').attr('src', '../' + respuesta.ruta);
                        $('#ruta_imagen').attr('value', '../' + respuesta.ruta);
                        $('#load').attr('class', 'imagenno');
                    }
                });
            });

            //Para el manejo de fechas
            var opciones_datepicker = {changeYear: true,
                dateFormat: "yy-mm-dd",
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                yearRange: "1950:2050"
            };
            $(document).ready(function (e) {
                $('#txtfn').datepicker(opciones_datepicker);
                $('#txtffc').datepicker(opciones_datepicker);
            });
        </script>


﻿<script language="javascript">
    $(document).ready(function () {
        $('#btmodificar').click(function () {
            alert($('input:radio[name=sex_per]:checked').val());
            var ruta = "../../Contralador/PacienteModificarController.php";
            $.ajax({
                url: ruta,
                type: 'POST',
                dataType: 'json',
                data: $('#FormModificarPaciente').serialize(),
                success: function (data) {
                    alert('hola');
                    //Parseamos el array JSON
                    alert(data.id_geo);
                    alert(data.id_per);
                    //$('#resultado').html(datos); // Mostrar la respuestas del script PHP.
                }
            });
        });
    });</script>

        <script language="javascript">
            //Sección para el autocompletado
            $(document).ready(function () {
                $('#txtlocalidad').autocomplete({
                    source: "../../Contralador/Localizacion.php",
                    select: function (event, ui) {
                        $('#id_loc').val(ui.item.id_loc);
                    }
                });
            });
        </script>
    </head>

    <body bgcolor="#67ADF3">
        <div id="cabecera">
            <img src="../../imagenes/lbanner-05.png" style="width:240px; height:80px;" />
        </div>
        <div id="titulo">
            Modificar una Paciente nueva
        </div>
        <div id="campos">
            <form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormModificar" id="FormModificar" enctype="multipart/form-data">
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
                                            <input type="hidden" name="txtcaspac" id="txtcaspac" value="" />
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

                                    </form>

                                    </div>
                                    </body>
                                    </html>
