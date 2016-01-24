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

                    $('#hdfechaDesde').val($('#txtfechaDesde').val());
                    $('#hdfechaHasta').val($('#txtfechaHasta').val());
                    $.ajax({
                        type: 'POST',
                        url: '../../Contralador/reporteIncidenciaController.php',
                        data: $('#form91').serialize(),
                        success: function (datos) {
                            $('#lista').html(datos);
                        }
                    })
                }).keyup();
            });
//            $(document).ready(function () {
//                $('#btbuscar').click(function () {
//                    $.ajax({
//                        type: 'POST',
//                        url: '../../Contralador/reporteIncidenciaController.php',
//                        data: $('#form91').serialize(),
//                        success: function (datos) {
//                            $('#lista').html(datos);
//                        }
//                    })
//                }).keyup();
//            });
        </script>
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
                $('#txtfechaDesde').datepicker(opciones_datepicker);
                $('#txtfechaHasta').datepicker(opciones_datepicker);
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
            <table width="100%" class="tabla">
                <tr>
                    <td align="center">REPORTE DE CASOS DE INCIDENCIA</td>
                </tr>
                <tr>
                    <form method="POST" action="../Reportes/reporte_pdf.php" name="form91" id="form91">
                        <td>Fehca Desde: <input type="text" name="txtfechaDesde" id="txtfechaDesde" placeholder="Fecha desde" class="cajatexto" readonly="readonly"/></td>
                        <td>Fecha Hasta: <input type="text" name="txtfechaHasta" id="txtfechaHasta" placeholder="Fecha hasta" class="cajatexto" readonly="readonly"/></td>

                        <td>
                            <!--<input type="button" name="btbuscar" id="btbuscar" value=""/></td>bt_actualizar-->
                            <button type="button" name="btbuscar" id="btbuscar"> <img src="../../imagenes/bt_actualizar.png" height="50"  width="50" align="absmiddle"/></button>
                            <td>
                                <button type="submit" name="btpdf" id="buscbtpdfar"> <img src="../../imagenes/pdf.png" height="50"  width="50" align="absmiddle"/></button>
                            </td>
                    </form>
                    <form method="POST" action="../Reportes/reporte_grafico.php" name="form91" id="form91" target="_new">
                        <input type="hidden" name="hdfechaDesde" id="hdfechaDesde" value="" />
                        <input type="hidden" name="hdfechaHasta" id="hdfechaHasta" value="" />
                        <td>
                            <button type="submit" name="btpgraficar" id="btpgraficar"> <img src="../../imagenes/bt_estadistico.png" height="50"  width="50" align="absmiddle"/></button>
                        </td>
                    </form>


                </tr>
            </table>
            <div id="lista" class="listado"></div>
        </section>

    </body>
</html>