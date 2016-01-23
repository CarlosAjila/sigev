<?php
$rs_localidades = ejecutar_sentencia(
        "SELECT * FROM enfemedad"); //Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
$localidad = mysqli_fetch_assoc($rs_localidades); //Mediante esta línea en la variable $localidad recibimos un arreglo con el resultado de la consulta
?>

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="../../jQuery/jquery.multiselect.css" rel="stylesheet" type="text/css"/>

<style type="text/css">
.imagenguardar
{
	background-image:url(../../imagenes/guardar.png);
	background-repeat:no-repeat;
	background-position:center;
	width:40px;
	height:40px;
	cursor:pointer;
	border:1px solid #000;
	border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  -o-border-radius: 4px;
}
</style>

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
            var ruta = "../../Contralador/PacienteController.php";
            $.ajax({
                url: ruta,
                type: 'POST',
                dataType: 'json',
                data: $('#FormRegistroPaciente').serialize(),
                success: function (data) {
                    alert(data.mensaje);
                    location.reload();
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
    <table width="100%">
    	<tr>
            <td colspan="2" style="background-color:#036; color:#FFF; font-weight:bold;">Datos de Paciente</td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtcedula" id="txtcedula" placeholder="Número de cédula" style="border:1px solid #000; width:100%;" value=""/></td>
            <td style="padding:2px;"><input type="text" name="txtfn" id="txtfn" placeholder="Fecha de nacimiento" style="border:1px solid #000; width:100%;" readonly="readonly"/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtpnombre" id="txtpnombre" placeholder="Primer nombre" style="border:1px solid #000; width:100%;" value=""/></td>
            <td style="padding:2px;"><input type="text" name="txtsnombre" id="txtsnombre" placeholder="Segundo nombre" style="border:1px solid #000; width:100%;" value=""/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtapaterno" id="txtapaterno" placeholder="Apellido paterno" style="border:1px solid #000; width:100%;" value=""/></td>
            <td style="padding:2px;"><input type="text" name="txtamaterno" id="txtamaterno" placeholder="Apellido materno" style="border:1px solid #000; width:100%;" value=""/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtcel" id="txtcel" placeholder="Número de celular" style="border:1px solid #000; width:100%;" value=""/></td>
            <td style="padding:2px;"><input type="text" name="txttel" id="txttel" placeholder="Número de teléfono" style="border:1px solid #000; width:100%;" value=""/></td>
        </tr>
        <tr>
            <td colspan="2" style="padding:2px;"><input type="text" name="txtemipac" id="txtemipac" placeholder="Email" style="border:1px solid #000; width:100%;" value=""/></td>
        </tr>

        <tr>
            <td style="padding:2px;" colspan="2">
                <input type="text" name="txtlocalidad" id="txtlocalidad" placeholder="Ingrese el nombre de su Barrio" style="border:1px solid #000; width:100%;"/>
                <input type="hidden" name="id_loc" id="id_loc" value="" />
            </td>
        </tr>
        <tr>
            <td style="padding:2px;" colspan="2">Sexo:   
                <input type="radio" name="sex_per" id="sex_per" value="M"> Masculino 
                <input type="radio" name="sex_per" id="sex_per" value="F"> Femenino
            </td>
        </tr>

        <tr>
            <td style="padding:2px;"><input type="text" name="txtexpac" id="txtexpac" placeholder="Lugar donde se realizó el exámen" style="border:1px solid #000; width:100%;" value=""/></td>
            <td style="padding:2px;">
                 <select name="id_enf" id="id_enf">
                    <option value="" selected>Seleccione una enfermedad</option>
                    <?php do { ?>
                        <option value="<?php echo $localidad["id_enf"]; ?>"><?php echo $localidad["nom_enf"]; ?></option>
                    <?php } while ($localidad = mysqli_fetch_assoc($rs_localidades)) ?>
                </select>
            
                <select name="cbOpciones" id="cbOpciones" >
                    <option value="" selected>Tipo de Caso</option>
                    <option value="Presuntivos">Presuntivos</option>
                    <option value="Presuntivos">Confirmados</option>
                </select>
                <input type="hidden" name="txtcaspac" id="txtcaspac" value="" />
            </td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtdirpac" id="txtdirpac" placeholder="Dirección domicilio" style="border:1px solid #000; width:100%;" value=""/></td>
            <td style="padding:2px;"><input type="text" name="txtrefpac" id="txtrefpac" placeholder="Referencia domicilio" style="border:1px solid #000; width:100%;" value=""/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtofipac" id="txtofipac" placeholder="Ocupacion" style="border:1px solid #000; width:100%;" value=""/></td>
            <td style="padding:2px;"><input type="text" name="txtdofpac" id="txtdofpac" placeholder="Direccion Trabajo" style="border:1px solid #000; width:100%;" value=""/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txfatpac" id="txfatpac" placeholder="Fecha antención" style="border:1px solid #000; width:100%;" readonly="readonly"/></td>
            <td style="padding:2px;"><input type="text" name="txfispac" id="txfispac" placeholder="Fecha inicio sintomas" style="border:1px solid #000; width:100%;" readonly="readonly"/></td></td>
        </tr>

        <input type="hidden" name="longitud" id="longitud" value="" />
        <input type="hidden" name="latitud" id="latitud" value="" />

        <tr >
            <td colspan="2" style="background-color:#036; color:#FFF; font-weight:bold; padding:2px;">Seleccione Sintomas</td>
        </tr>
        <tr>
        	<td colspan="2" style="background-color:#95C6F7; padding:2px;">
            <div style="overflow:auto; height:170px; width:100%;">
                <?php
                $rs_localidades = ejecutar_sentencia("SELECT id_sin, nom_sin FROM sintoma WHERE est_sin= 'A'");
                $sintomas = mysqli_fetch_assoc($rs_localidades);?>
                
				<?php
                do {
                    ?>
                    <input type="checkbox" name="chk[]"  value="<?php echo $sintomas["id_sin"]; ?>"><?php echo $sintomas["nom_sin"]; ?></br>
				<?php } while ($sintomas = mysqli_fetch_assoc($rs_localidades));
                ?>
            </div>    
            </td>
        </tr>
        <tr>
            <td align="center" style="padding:2px;"><input type="button" name="btguardar" id="btguardar" class="imagenguardar"/></td>
            <td align="center" style="padding:2px;"><input type="button" name="btcancelar" id="btcancelar" value="CANCELAR"/></td>
        </tr>
    </table>

</form>

