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
loc.id_loc,
loc.nom_loc,
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
pac.id_pac,
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
pac.est_pac,
penf.id_enf,
enf.nom_enf,
paenf.id_pae
FROM persona per 
INNER JOIN paciente pac ON per.id_per = pac.id_per 
INNER JOIN georeferenciacion geo ON geo.id_geo = pac.id_geo
INNER JOIN paciente_enfermedad penf ON penf.id_pac = pac.id_pac
INNER JOIN enfemedad enf ON enf.id_enf = penf.id_enf
INNER JOIN localizacion loc ON loc.id_loc = per.id_loc
INNER JOIN paciente_enfermedad paenf ON paenf.id_pac = pac.id_pac
WHERE per.id_per = '" . $id . "'"); //Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
$localidad = mysqli_fetch_assoc($rs_localidades); //Mediante esta línea en la variable $localidad recibimos un arreglo con el resultado de la consulta


$valores_Expac = array("LABORATORIO", "CLINICA", "HOSPITAL", "SUBCENTRO DE SALUD", "CENTRO PARTICULAR", "OTRO"); //VALORES TIPO DE MAQUINARIA
$valores_Caspac = array("PRESUNTIVO", "CONFIRMADO"); //VALORES TIPO DE MAQUINARIA
$valores_Ofipac = array("DOCENTE", "ESTUDIANTE", "INGENIERO", "MÉDICO", "ALBAÑIL", "OTRO"); //VALORES TIPO DE MAQUINARIA
$i =0;
echo '<script language="javascript">'
. '$(document).ready(function(){';
echo '$("#id_enf").val("'.$localidad ["id_enf"].'")';
echo '})</script>';

echo '<script language="javascript">'
. '$(document).ready(function(){';
echo '$("#txtexpac").val("'.$localidad ["oex_pac"].'")';
echo '})</script>';

echo '<script language="javascript">'
. '$(document).ready(function(){';
echo '$("#txtcaspac").val("'.$localidad ["cas_pac"].'")';
echo '})</script>';

echo '<script language="javascript">'
. '$(document).ready(function(){';
echo '$("#txtofipac").val("'.$localidad ["ofi_pac"].'")';
echo '})</script>';


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

<script language="javascript">
    $(document).ready(function () {
        $('#btmodificar').click(function (e) {

            var ruta = "../../Contralador/PacienteController.php";
            $.ajax({
                url: ruta,
                type: 'POST',
                dataType: 'json',
                data: $('#FormModificarPaciente').serialize(),
                success: function (data) {
                    //Parseamos el array JSON
                    alert(data.mensaje);
                }
            });
            alert("Edición exitosa");
            location.reload();
        });
    });
</script>


﻿<script language="javascript">
    $(document).ready(function () {
        $('#btmodificar').click(function () {
            var ruta = "../../Contralador/PacienteController.php";
            var cedu = window.document.FormRegistroPaciente.txtcedula.value;

            if (cedu == "")
            {
                alert("Debe Ingresar el # Cedula")
                document.FormRegistroPaciente.txtcedula.focus();
                return false;
                isNotOk = true;
            }

            var numero = window.document.FormRegistroPaciente.txtcedula.value;
            if (cedu != "")
            {
                var suma = 0;
                var p1 = 0;
                var residuo = 0;
                var pri = false;
                var pub = false;
                var nat = false;
                var numeroProvincias = 22;
                var modulo = 11;

                /* Verifico que el campo no contenga letras */
                var ok = 1;
                for (i = 0; i; numeroProvincias) {
                    alert("El c" + '\u00f3' + "digo de la provincia (dos primeros dígitos) es inv" + '\u00e1' + "lido");
                    document.FormRegistroPaciente.txtcedula.focus();
                    return false;
                }

                /* Aqui almacenamos los digitos de la cedula en variables. */
                d1 = numero.substr(0, 1);
                d2 = numero.substr(1, 1);
                d3 = numero.substr(2, 1);
                d4 = numero.substr(3, 1);
                d5 = numero.substr(4, 1);
                d6 = numero.substr(5, 1);
                d7 = numero.substr(6, 1);
                d8 = numero.substr(7, 1);
                d9 = numero.substr(8, 1);
                d10 = numero.substr(9, 1);

                /* El tercer digito es: */
                /* 9 para sociedades privadas y extranjeros */
                /* 6 para sociedades publicas */
                /* menor que 6 (0,1,2,3,4,5) para personas naturales */

                if (d3 == 7 || d3 == 8) {
                    alert("El tercer d" + '\u00ed' + "gito ingresado es inv" + '\u00e1' + "lido");
                    document.FormRegistroPaciente.txtcedula.focus();
                    return false;
                }

                /* Solo para personas naturales (modulo 10) */
                if (d3 < 6) {
                    nat = true;
                    p1 = d1 * 2;
                    if (p1 >= 10)
                        p1 -= 9;
                    p2 = d2 * 1;
                    if (p2 >= 10)
                        p2 -= 9;
                    p3 = d3 * 2;
                    if (p3 >= 10)
                        p3 -= 9;
                    p4 = d4 * 1;
                    if (p4 >= 10)
                        p4 -= 9;
                    p5 = d5 * 2;
                    if (p5 >= 10)
                        p5 -= 9;
                    p6 = d6 * 1;
                    if (p6 >= 10)
                        p6 -= 9;
                    p7 = d7 * 2;
                    if (p7 >= 10)
                        p7 -= 9;
                    p8 = d8 * 1;
                    if (p8 >= 10)
                        p8 -= 9;
                    p9 = d9 * 2;
                    if (p9 >= 10)
                        p9 -= 9;
                    modulo = 10;
                }

                /* Solo para sociedades publicas (modulo 11) */
                /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
                else if (d3 == 6) {
                    pub = true;
                    p1 = d1 * 3;
                    p2 = d2 * 2;
                    p3 = d3 * 7;
                    p4 = d4 * 6;
                    p5 = d5 * 5;
                    p6 = d6 * 4;
                    p7 = d7 * 3;
                    p8 = d8 * 2;
                    p9 = 0;
                }

                /* Solo para entidades privadas (modulo 11) */
                else if (d3 == 9) {
                    pri = true;
                    p1 = d1 * 4;
                    p2 = d2 * 3;
                    p3 = d3 * 2;
                    p4 = d4 * 7;
                    p5 = d5 * 6;
                    p6 = d6 * 5;
                    p7 = d7 * 4;
                    p8 = d8 * 3;
                    p9 = d9 * 2;
                }

                suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
                residuo = suma % modulo;

                /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
                digitoVerificador = residuo == 0 ? 0 : modulo - residuo;

                /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
                if (pub == true) {
                    if (digitoVerificador != d9) {
                        alert("El ruc de la empresa del sector p" + '\u00fa' + "blico es incorrecto.");
                        document.FormRegistroPaciente.txtcedula.focus();
                        return false;
                    }
                    /* El ruc de las empresas del sector publico terminan con 0001*/
                    if (numero.substr(9, 4) != '0001') {
                        alert("El ruc de la empresa del sector p" + '\u00fa' + "blico debe terminar con 0001");
                        document.FormRegistroPaciente.txtcedula.focus();
                        return false;
                    }
                }
                else if (pri == true) {
                    if (digitoVerificador != d10) {
                        alert('El ruc de la empresa del sector privado es incorrecto.');
                        document.FormRegistroPaciente.txtcedula.focus();
                        return false;
                    }
                    if (numero.substr(10, 3) != '001') {
                        alert('El ruc de la empresa del sector privado debe terminar con 001');
                        document.FormRegistroPaciente.txtcedula.focus();
                        return false;
                    }
                }

                else if (nat == true) {
                    if (digitoVerificador != d10) {
                        alert("El n" + '\u00fa' + "mero de c" + '\u00e9' + "dula de la persona natural es incorrecto.");
                        document.FormRegistroPaciente.txtcedula.focus();
                        document.FormRegistroPaciente.txtcedula = "";
                        return false;
                        isNotOk = true;
                    }

                    if (numero.length > 10 && numero.substr(10, 3) != '001') {
                        alert('El ruc de la persona natural debe terminar con 001');
                        document.FormRegistroPaciente.txtcedula.focus();
                        return false;
                    }
                }
            }

            var isNotOk;
            var pno = window.document.FormRegistroPaciente.txtpnombre.value;
            if (pno == "")
            {
                alert("Debe ingresar su primer nombre")
                document.FormRegistroPaciente.txtpnombre.focus();
                return false;
                isNotOk = true;
            }

            var isNotOk;
            var sno = window.document.FormRegistroPaciente.txtsnombre.value;
            if (sno == "")
            {
                alert("Debe ingresar su segundo nombre")
                document.FormRegistroPaciente.txtsnombre.focus();
                return false;
                isNotOk = true;
            }

            var isNotOk;
            var apa = window.document.FormRegistroPaciente.txtapaterno.value;
            if (apa == "")
            {
                alert("Debe ingresar su apellido paterno")
                document.FormRegistroPaciente.txtapaterno.focus();
                return false;
                isNotOk = true;
            }

            var isNotOk;
            var ama = window.document.FormRegistroPaciente.txtamaterno.value;
            if (ama == "")
            {
                alert("Debe ingresar su apellido materno")
                document.FormRegistroPaciente.txtamaterno.focus();
                return false;
                isNotOk = true;
            }

            var isNotOk;
            var bar = window.document.FormRegistroPaciente.txtlocalidad.value;
            if (bar == "")
            {
                alert("Debe ingresar su barrio de domicilio")
                document.FormRegistroPaciente.txtlocalidad.focus();
                return false;
                isNotOk = true;
            }

            if (isNotOk)
            {
                return false;
            }
            else
            {
                $.ajax({
                    url: ruta,
                    type: 'POST',
                    dataType: 'json',
                    data: $('#FormModificarPaciente').serialize(),
                    success: function (data) {
                        alert(data.mensaje);
                        location.reload();
                    }
                });
                alert('Paciente Modificado con éxito.');
                location.reload();
            }
        });

        $('#btcancelar').click(function (e) {
            location.reload();
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
        });
    });
//    $(document).on('ready', function () {
//        $('#cbExpac').change(function () {
//            var seleccion = $('#cbExpac option:selected').text();
//            $('#txtexpac').val(seleccion);
//        });
//    });

//$(document).ready(function(){';
//echo '$("#txtexpac").val("'.$localidad ["fis_pac"].'")';
//echo '});




    $(document).on('ready', function () {
        $('#cbofipac').change(function () {
            var seleccion = $('#cbofipac option:selected').text();
            $('#txtofipac').val(seleccion);
        });
    });
</script>

<form method="POST" action="../../Contralador/PacienteController.php" name="FormModificarPaciente" id="FormModificarPaciente" enctype="multipart/form-data">
    <input id="modificar_paciente" name="modificar_paciente" type="hidden" value="modificar_paciente"/>
    <table width="100%">
        <tr>
            <td colspan="2" style="background-color:#036; color:#FFF; font-weight:bold;">Datos de Paciente</td>
        </tr>
        <tr>
        <input type="hidden" name="id_per" id="id_per" value="<?php echo $localidad ["id_per"] ?>" />
        <input type="hidden" name="fre_pac" id="fre_pac" value="<?php echo $localidad ["fre_pac"] ?>" />
        <input type="hidden" name="id_pac" id="fre_pac" value="<?php echo $localidad ["id_pac"] ?>" />
        <td style="padding:2px;"><input type="text" name="txtcedula" id="txtcedula" placeholder="Número de cédula" style="border:1px solid #000; width:100%;" onkeypress="return validar_num(event)" value="<?php echo $localidad ["ced_per"] ?>" maxlength="10"/></td>
        <td style="padding:2px;"><input type="text" name="txtfn" id="txtfn" placeholder="Fecha de nacimiento" style="border:1px solid #000; width:100%;" readonly="readonly" value="<?php echo $localidad ["fna_per"] ?>"/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtpnombre" id="txtpnombre" placeholder="Primer nombre" style="border:1px solid #000; width:100%;" onkeypress="return validar(event)" value="<?php echo $localidad ["pno_per"] ?>"/></td>
            <td style="padding:2px;"><input type="text" name="txtsnombre" id="txtsnombre" placeholder="Segundo nombre" style="border:1px solid #000; width:100%;" onkeypress="return validar(event)" value="<?php echo $localidad ["sno_per"] ?>"/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtapaterno" id="txtapaterno" placeholder="Apellido paterno" style="border:1px solid #000; width:100%;" onkeypress="return validar(event)" value="<?php echo $localidad ["apa_per"] ?>"/></td>
            <td style="padding:2px;"><input type="text" name="txtamaterno" id="txtamaterno" placeholder="Apellido materno" style="border:1px solid #000; width:100%;" onkeypress="return validar(event)" value="<?php echo $localidad ["ama_per"] ?>"/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtcel" id="txtcel" placeholder="Número de celular" style="border:1px solid #000; width:100%;" onkeypress="return validar_num(event)" value="<?php echo $localidad ["te1_per"] ?>"/></td>
            <td style="padding:2px;"><input type="text" name="txttel" id="txttel" placeholder="Número de teléfono" style="border:1px solid #000; width:100%;" onkeypress="return validar_num(event)" value="<?php echo $localidad ["te2_per"] ?>"/></td>
        </tr>
        <tr>
            <td colspan="2" style="padding:2px;"><input type="text" name="txtemipac" id="txtemipac" placeholder="Email" style="border:1px solid #000; width:100%;" value="<?php echo $localidad ["emi_pac"] ?>"/></td>
        </tr>

        <tr>
            <td style="padding:2px;" colspan="2">
                <input type="text" name="txtlocalidad" id="txtlocalidad" placeholder="Ingrese el nombre de su Barrio" style="border:1px solid #000; width:100%;" value="<?php echo $localidad ["nom_loc"] ?>"/>
                <input type="hidden" name="id_loc" id="id_loc" value="<?php echo $localidad ["id_loc"] ?>" />
            </td>
        </tr>
        <tr>
            <td style="padding:2px;" colspan="2">Sexo:   
<!--                <input type="radio" name="sex_per" id="sex_per" value="M"> Masculino 
                <input type="radio" name="sex_per" id="sex_per" value="F"> Femenino-->
                	<?php
					if($localidad ["sex_per"] == "M"){	
						echo '<input type="radio" name="sex_per" id="sex_per" value="M" checked = "checked"> Masculino';
						echo '<input type="radio" name="sex_per" id="sex_per" value="F"> Femenino';
					}
					else{
						echo '<input type="radio" name="sex_per" id="sex_per" value="M"> Masculino';
						echo '<input type="radio" name="sex_per" id="sex_per" value="F" checked = "checked"> Femenino';
					}
				?>
            </td>
        </tr>

        <tr>
            <td style="padding:2px;">
                <select name="txtexpac"id="txtexpac"> 
                    <?php
                    do {
                        echo '<option value="' . $valores_Expac[$i] . '">' . $valores_Expac[$i] . '</option>';
                        $i++;
                    } while ($i < sizeof($valores_Expac));
                    ?>
                </select>
            </td>
            <td style="padding:2px;">
                <select name="id_enf" id="id_enf">
                    <?php 
                    $rs_enfermedad = ejecutar_sentencia(
                                "SELECT * FROM enfemedad");
                        $localidad_enfermedad = mysqli_fetch_assoc($rs_enfermedad);

                    do { ?>
                        <option value="<?php echo $localidad_enfermedad["id_enf"]; ?>"><?php echo $localidad_enfermedad["nom_enf"]; ?></option>
                    <?php } while ($localidad_enfermedad = mysqli_fetch_assoc($rs_enfermedad)) ?>
                </select>
                
                  <select name="txtcaspac"id="txtcaspac">
                    <?php
                    $j=0;
                    do {
                        echo '<option value="' . $valores_Caspac[$j] . '">' . $valores_Caspac[$j] . '</option>';
                        $j++;
                    } while ($j < sizeof($valores_Caspac));
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txtdirpac" id="txtdirpac" placeholder="Dirección domicilio" style="border:1px solid #000; width:100%;" value="<?php echo $localidad ["dir_pac"] ?>"/></td>
            <td style="padding:2px;"><input type="text" name="txtrefpac" id="txtrefpac" placeholder="Referencia domicilio" style="border:1px solid #000; width:100%;" value="<?php echo $localidad ["ref_pac"] ?>"/></td>
        </tr>
        <tr>
            <td style="padding:2px;">
                 <select name="txtofipac"id="txtofipac"> 
                    <?php
                    $k=0;
                    do {
                        echo '<option value="' . $valores_Ofipac[$k] . '">' . $valores_Ofipac[$k] . '</option>';
                        $k++;
                    } while ($k < sizeof($valores_Ofipac));
                    ?>
                </select>
            </td>
            <td style="padding:2px;"><input type="text" name="txtdofpac" id="txtdofpac" placeholder="Direccion Trabajo" style="border:1px solid #000; width:100%;" value="<?php echo $localidad ["dof_pac"] ?>"/></td>
        </tr>
        <tr>
            <td style="padding:2px;"><input type="text" name="txfatpac" id="txfatpac" placeholder="Fecha de atención" style="border:1px solid #000; width:100%;" readonly="readonly" value="<?php echo $localidad ["fat_pac"] ?>"/></td>
            <td style="padding:2px;"><input type="text" name="txfispac" id="txfispac" placeholder="Fecha inicio sintomas" style="border:1px solid #000; width:100%;" readonly="readonly" value="<?php echo $localidad ["fis_pac"] ?>"/></td></td>
        </tr>

        <input type="hidden" name="longitud" id="longitud" value="" />
        <input type="hidden" name="latitud" id="latitud" value="" />
        <input type="hidden" name="id_geo" id="id_geo" value="<?php echo $localidad ["id_geo"] ?>" />

        <tr >
            <td colspan="2" style="background-color:#036; color:#FFF; font-weight:bold; padding:2px;">Seleccione Sintomas</td>
        </tr>
        <tr>
            <td colspan="2" style="background-color:#95C6F7; padding:2px;">
                <div style="overflow:auto; height:170px; width:100%;">
                    <?php
                    $rs_localidades = ejecutar_sentencia("SELECT id_sin, nom_sin FROM sintoma WHERE est_sin= 'A'");
                    $sintomas = mysqli_fetch_assoc($rs_localidades);
                    $rs_localidades_sin_pac_enf = ejecutar_sentencia("SELECT * FROM sintoma_paciente WHERE id_pae = '".$localidad ["id_pae"]."'");
                    $sin_pac_enf = mysqli_fetch_assoc($rs_localidades_sin_pac_enf);
                    $c=0;
                    do {
                             $vector[$c] = $sin_pac_enf['id_sin'];
                             $c++;
                    } while ($sin_pac_enf = mysqli_fetch_assoc($rs_localidades_sin_pac_enf));
                    
                    do {
                        $activar = 0;
                        for($f=0;$f<$c;$f++){
                            if($sintomas["id_sin"] == $vector[$f]){
                                $activar=1;
                            }
                        } 
                        if($activar==1){
                        ?>
                        <input type="checkbox"  name="chk[]"  value="<?php echo $sintomas["id_sin"]; ?>"  checked="checked"/><?php echo $sintomas["nom_sin"]; ?></br>
                    <?php 
                        }else{
                    ?>  
                        <input type="checkbox"  name="chk[]"  value="<?php echo $sintomas["id_sin"]; ?>"><?php echo $sintomas["nom_sin"]; ?></br>
                    <?php 
                        }
                    } while ($sintomas = mysqli_fetch_assoc($rs_localidades));
                    ?>
                </div>    
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td align="center" style="padding:2px;"><input type="button" name="btmodificar" id="btmodificar" value="MODIFICAR"/></td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td align="center" style="padding:2px;"><input type="button" name="btcancelar" id="btcancelar" class="imagencancelar"/></td>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td align="center" >Guardar</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td align="center">Cancelar</td>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
    </table>

</form>


