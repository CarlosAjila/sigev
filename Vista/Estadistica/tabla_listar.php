<?php
//$mysqli = new mysqli('localhost','root','','asamurat');
//if(isset($_POST['cekhapus'])){
//	$hasil = $mysqli->query("delete from tbl_surat_masuk where id in ('".implode("','",array_values($_POST['checkbox']))."')");
//	if($hasil){
//		
?>
<!--<script>alert('Success delete data');location.href='tabla_listar.php'</script>-->
<?php
//	} else{
//		
?>
<!--<script>alert('Failed delete data');location.href='tabla_listar.php'</script>-->
<?php
//	}
//}
?>
<script language="javascript">
    $(document).ready(function () {
        alert('sdsdsdsada entro')
        var value = $(this).val();
            $.ajax({
                type: 'POST',
                url: '../../Contralador/listar_paciente.php',
                data: 'dato=' + value,
                success: function (datos) {
                    $('#lista').html(datos);
                }
            })
//        $('#txtbuscar').keyup(function () {
//            
//        }).keyup();
    }).keyup();
</script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../jQuery/dataTables.bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <form method="post">
                <h1>Tabel Data Select All! <button type="submit" name="cekhapus" class="btn btn-danger">Delete Selected</button></h1>
                <table class="table table-bordered table-striped" id="tabeldata">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"/></th>
                            <th>CI</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>CASO</th>
                            <th>SEXO</th>
                            <th>FECHA DE ATECION</th>
                            <th>FECHA INICIO SINTOMA</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" id="select-all2"/></th>
                            <th>CI</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>CASO</th>
                            <th>SEXO</th>
                            <th>FECHA DE ATECION</th>
                            <th>FECHA INICIO SINTOMA</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <div id="lista">
                    </div>
                    </tbody>
                </table>
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="../../jQuery/dataTables.bootstrap.min.js"></script>
        <script src="../../jQuery/jquery.dataTables.min.js"></script>
        <script src="../../jQuery/dataTables.bootstrap.min.js"></script>
        <script>
        $(document).ready(function () {
            $('#tabeldata').dataTable();
            $('#select-all').click(function () {
                if (this.checked) {
                    $(':checkbox').each(function () {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function () {
                        this.checked = false;
                    });
                }
            });
            $('#select-all2').click(function () {
                if (this.checked) {
                    $(':checkbox').each(function () {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function () {
                        this.checked = false;
                    });
                }
            });
        });
        </script>
    </body>
</html>