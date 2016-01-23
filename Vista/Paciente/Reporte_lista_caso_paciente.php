<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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

        <title>SIGEV - Listar Usuarios</title>
        <script language="javascript">
            $(document).ready(function () {
                $('#btbuscar').click(function () {
                    $.ajax({
                        type: 'POST',
                        url: '../../Contralador/reporteListaCasoPacienteController.php',
                        data: $('#form91').serialize(),
                        success: function (datos) {
                            $('#lista').html(datos);
                        }
                    })
                }).keyup();
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

    <body>

        <header>
            <div id="conte" class="contenedor">


                <h1><img src="../../imagenes/lbanner-05.png" class="logo" /></h1>
                <input type="checkbox" id="menu-bar" />
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menu">
                    <a href="../Estadistica/Inicio.php" style="font-size:18px;" class="icon-inicio">Inicio</a>
                </nav>
                <nav class="menu">
                    <a href="../Paciente/Reporte_lista_caso_paciente.php" style="font-size:18px;" class="icon-iniciar-sesion">Lista por Casos</a>
                    <a href="../Paciente/Reporte_incidencia_fecha.php" style="font-size:18px;" class="icon-iniciar-sesion">Lista de Incidencia</a>
                </nav>
            </div>
        </header>
        <section class="cuerpo">
            <table width="50%" class="tabla" align="center">
                <tr>
                    <td align="center" style="font-size: 16px">REPORTE DE CASOS DE INCIDENCIA</td>
                </tr>
                <tr>
                    <form method="POST" action="../Reportes/reporte_lista_caso_paciente_pdf.php" name="form91" id="form91">
                        <td>
                            <select name="cbOpciones" id="cbOpciones" >
                                <option value="" selected>Seleccione tipo de Caso</option>
                                <option value="Presuntivos">Presuntivos</option>
                                <option value="Presuntivos">Confirmados</option>
                                <option value="Todos">Todos</option>
                            </select>
                            <input type="hidden" name="txtcaspac" id="txtcaspac" value="" />
                        </td>
                        <td>
                            <button type="button" name="btbuscar" id="btbuscar"> <img src="../../imagenes/bt_actualizar.png" height="50"  width="50" align="absmiddle"/></button>
                        </td>
                        <td>
                            <button type="submit" name="btpdf" id="buscbtpdfar"> <img src="../../imagenes/pdf.png" height="50"  width="50" align="absmiddle"/></button>
                        </td>
                    </form>
                </tr>
            </table>
            <div id="lista" class="listado"></div>
        </section>

    </body>
</html>