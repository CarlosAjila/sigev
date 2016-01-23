<?php
$rs_localidades = ejecutar_sentencia(
        "SELECT * FROM enfemedad"); //Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
$localidad = mysqli_fetch_assoc($rs_localidades); //Mediante esta línea en la variable $localidad recibimos un arreglo con el resultado de la consulta
?>

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="../../jQuery/jquery.multiselect.css" rel="stylesheet" type="text/css"/>

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
            //alert($('input:radio[name=sex_per]:checked').val());
            var ruta = "../../Contralador/PacienteController.php";
            $.ajax({
                url: ruta,
                type: 'POST',
                dataType: 'json',
                data: $('#FormRegistroPaciente').serialize(),
                success: function (data) {
                    alert(data.mensaje);
                    alert(data.num);
                    location.reload();
                    //document.getElementById('FormRegistroPaciente').submit();     
                    //$('#resultado').html(datos); // Mostrar la respuestas del script PHP.
                }
            });
        });

        $('#btcancelar').click(function (e) {
            document.getElementById('FormRegistroPaciente').submit();
        });
    });
</script>

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



<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormRegistroPaciente" id="FormRegistroPaciente" enctype="multipart/form-data">
    <input id="save_paciente" name="save_paciente" type="hidden" value="save_paciente"/>
    <table class="contenedor" border="0">
        <tr>
            <td><input type="text" name="txtcedula" id="txtcedula" placeholder="Número de cédula" class="cajatexto" value=""/></td>
            <td><input type="text" name="txtfn" id="txtfn" placeholder="Fecha de nacimiento" class="cajatexto" readonly="readonly"/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtpnombre" id="txtpnombre" placeholder="Primer nombre" class="cajatexto" value=""/></td>
            <td><input type="text" name="txtsnombre" id="txtsnombre" placeholder="Segundo nombre" class="cajatexto" value=""/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtapaterno" id="txtapaterno" placeholder="Apellido paterno" class="cajatexto" value=""/></td>
            <td><input type="text" name="txtamaterno" id="txtamaterno" placeholder="Apellido materno" class="cajatexto" value=""/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtcel" id="txtcel" placeholder="Número de celular" class="cajatexto" value=""/></td>
            <td><input type="text" name="txttel" id="txttel" placeholder="Número de teléfono" class="cajatexto" value=""/></td>
        </tr>
        <tr>
            <td colspan="3"><input type="text" name="txtemipac" id="txtemipac" placeholder="Email" class="email" value=""/></td>
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
            <td><input type="text" name="txtexpac" id="txtexpac" placeholder="Lugar donde se realizó el exámen" class="cajatexto" value=""/></td>
            <td>
                <select name="cbOpciones" id="cbOpciones" class="form-control">
                    <option value="" selected>Tipo de Caso</option>
                    <option value="Presuntivos">Presuntivos</option>
                    <option value="Presuntivos">Confirmados</option>
                </select>
                <input type="hidden" name="txtcaspac" id="txtcaspac" value="" />
            </td>
        </tr>
        <tr>
            <td><input type="text" name="txtdirpac" id="txtdirpac" placeholder="Dirección domicilio" class="cajatexto" value=""/></td>
            <td><input type="text" name="txtrefpac" id="txtrefpac" placeholder="Referencia domicilio" class="cajatexto" value=""/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtofipac" id="txtofipac" placeholder="Ocupacion" class="cajatexto" value=""/></td>
            <td><input type="text" name="txtdofpac" id="txtdofpac" placeholder="Direccion Trabajo" class="cajatexto" value=""/></td>
        </tr>
        <tr>
            <td><input type="text" name="txfatpac" id="txfatpac" placeholder="Fecha antención" class="cajatexto" readonly="readonly"/></td>
            <td><input type="text" name="txfispac" id="txfispac" placeholder="Fecha inicio sintomas" class="cajatexto" readonly="readonly"/></td></td>
        </tr>

        <input type="hidden" name="longitud" id="longitud" value="" />
        <input type="hidden" name="latitud" id="latitud" value="" />

        <tr>
            <td colspan="2">
                <select name="id_enf" id="id_enf" class="form-control">
                    <option value="" selected>Seleccione una enfermedad</option>
                    <?php do { ?>
                        <option value="<?php echo $localidad["id_enf"]; ?>"><?php echo $localidad["nom_enf"]; ?></option>
                    <?php } while ($localidad = mysqli_fetch_assoc($rs_localidades)) ?>
                </select>
            </td>

        </tr>
        <tr >
            <td colspan="2">
                <br>Seleccione Sintomas<br>
                <?php
                $rs_localidades = ejecutar_sentencia("SELECT id_sin, nom_sin FROM sintoma WHERE est_sin= 'A'");
                $sintomas = mysqli_fetch_assoc($rs_localidades);
                do {
                    ?>
                    <input type="checkbox" name="chk[]"  value="<?php echo $sintomas["id_sin"]; ?>"><?php echo $sintomas["nom_sin"]; ?><br>
                <?php } while ($sintomas = mysqli_fetch_assoc($rs_localidades));
                ?>

            </td>
<!--            <td colspan="2" align="center">
                <div class="container">
                    <select name="country" multiple class="form-control">
                        <option value="" selected>Seleccione Síntomas</option>
            <?php
            $rs_localidades = ejecutar_sentencia("SELECT id_sin, nom_sin FROM sintoma WHERE est_sin= 'A'");
            $sintomas = mysqli_fetch_assoc($rs_localidades);
            do {
                ?>
                                            <option name = "chk[]" id ="chk[]" value="<?php echo $sintomas["id_sin"]; ?>"><?php echo $sintomas["nom_sin"]; ?></option>
            <?php } while ($sintomas = mysqli_fetch_assoc($rs_localidades));
            ?>
                    </select>

                </div>
                                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script src="../../jQuery/jquery.multiselect.js"></script>
                <script>
    $('select[multiple]').multiselect({
        columns: 3,
        placeholder: 'Select options'
    });
                </script>
            </td>-->
        </tr>
        <tr>
            <td colspan="3" align="center"><input type="button" name="btguardar" id="btguardar" value="GUARDAR"/></td>
            <td colspan="3" align="center"><input type="button" name="btcancelar" id="btcancelar" value="CANCELAR"/></td>
        </tr>
    </table>

</form>

<!--fdgdkfñgl-->
