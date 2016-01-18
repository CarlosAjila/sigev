


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
    <table class="contenedor" border="1">
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
 
        <input type="hidden" name="longitud" id="longitud" value="" />
        <input type="hidden" name="latitud" id="latitud" value="" />
        <tr>
            <td colspan="3"><input type="button" name="btguardar" id="btguardar" value="GUARDAR"/></td>
        </tr>
    </table>

</form>

