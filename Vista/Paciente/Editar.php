<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
        <link rel="stylesheet" type="text/css" href="../../Estilos/EstiloRegistrar.css" />
        <link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
        <script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
        <script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="../../AjaxUpload.2.0.min.js"></script>

        <title>SIGEV-Modificar Paciente</title>

        <script language="javascript">

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
                $('#txtfrepac').datepicker(opciones_datepicker);
                $('#txfatpac').datepicker(opciones_datepicker);
                $('#txfispac').datepicker(opciones_datepicker);
            });</script>

        ﻿<script language="javascript">
            $(document).ready(function () {
                $('#btguardar').click(function () {
                    alert($('input:radio[name=sex_per]:checked').val());
                    var ruta = "../../Contralador/PacienteController.php";
                    $.ajax({
                        url: ruta,
                        type: 'POST',
                        dataType: 'json',
                        data: $('#FormRegistroPaciente').serialize(),
                        success: function (data) {
                            //alert('hola');
                            //Parseamos el array JSON
                            alert(data.mensaje);
                            alert(data.id_geo);
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
        <script language="javascript">
            $(document).on('ready', function () {
                $('#cbOpciones').change(function () {
                    var seleccion = $('#cbOpciones option:selected').text();
                    $('#txtcaspac').val(seleccion);
                    //alert(seleccion);

                });
            });
        </script>
    </head>

    <body bgcolor="#67ADF3">
        <div id="cabecera">
            <img src="../../imagenes/lbanner-05.png" style="width:240px; height:80px;" />
        </div>
        <div id="titulo">
            Modificar Paciente
        </div>
        <div id="campos">
            <form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormRegistroPaciente" id="FormRegistroPaciente" enctype="multipart/form-data">
                <input id="save_paciente" name="save_paciente" type="hidden" value="save_paciente"/>
                <table class="contenedor" border="1">
                    <tr>
                        <td colspan="2" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtcedula" id="txtcedula" placeholder="Número de cédula" class="cajatexto" value="0703865584"/></td>
                        <td><input type="text" name="txtfn" id="txtfn" placeholder="Fecha de nacimiento" class="cajatexto" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtpnombre" id="txtpnombre" placeholder="Primer nombre" class="cajatexto" value="carlos1"/></td>
                        <td><input type="text" name="txtsnombre" id="txtsnombre" placeholder="Segundo nombre" class="cajatexto" value="alberto1"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtapaterno" id="txtapaterno" placeholder="Apellido paterno" class="cajatexto" value="ajila1"/></td>
                        <td><input type="text" name="txtamaterno" id="txtamaterno" placeholder="Apellido materno" class="cajatexto" value="moreira1"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtcel" id="txtcel" placeholder="Número de celular" class="cajatexto" value="1234567890"/></td>
                        <td><input type="text" name="txttel" id="txttel" placeholder="Número de teléfono" class="cajatexto" value="1234567890"/></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" name="txtemipac" id="txtemipac" placeholder="Email" class="email" value="carlos@gmail.com"/></td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" name="txtlocalidad" id="txtlocalidad" placeholder="Ingrese el nombre de su parroquia" class="cajatexto"/>
                            <input type="hidden" name="id_loc" id="id_loc" value="" />
                        </td>
                        <td>
                            <input type="radio" name="sex_per" id="sex_per" value="M">M
                                <input type="radio" name="sex_per" id="sex_per" value="F">F
                                    </td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="txtexpac" id="txtexpac" placeholder="Lugar donde se realizó el Examen" class="cajatexto" value="lugar1"/></td>
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
<!--                                            <input type="text" name="txtcaspac" id="txtcaspac" placeholder="Caso del Paciente " class="cajatexto" value="Presuntivo"/></td>-->
                                            <td><input type="text" name="txtdirpac" id="txtdirpac" placeholder="Dirección Domicilio" class="cajatexto" value="dir Domicilio"/></td>
                                            <td><input type="text" name="txtrefpac" id="txtrefpac" placeholder="Referencia Domicilio" class="cajatexto" value="Rf domiciliio"/></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="txtofipac" id="txtofipac" placeholder="Ocupacion" class="cajatexto" value="dir trabajo" value="Director"/></td>
                                        <td><input type="text" name="txtdofpac" id="txtdofpac" placeholder="Direccion Trabajo" class="cajatexto" value="palmera"/></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="txfatpac" id="txfatpac" placeholder="Fecha Antencion" class="cajatexto" readonly="readonly"/></td>
                                        <td><input type="text" name="txfispac" id="txfispac" placeholder="Fecha inicio Sintomas" class="cajatexto" readonly="readonly"/></td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><input type="button" name="btguardar" id="btguardar" value="GUARDAR"/></td>
                                    </tr>
                    </table>
                </form>
            </div>
        </body>
    </html>
