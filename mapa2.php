 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js" type="text/javascript"></script>
        <script src=""></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>

        <script src="js/funcionesMenu.js"></script>
        <script src="js/gmap3.js"></script>
        <!--<script src="js/docs.min.js"></script>-->

<?php
$lonOrigen = '-80.2394';
$latOrigen = '-3.4842';
?>
<style>
    body{

    }
    .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 100%;
        height: 400px;
    }
</style>
<script type="text/javascript">

    $(function() {

    $('#test1').gmap3({
    map: {
    options: {
    //localizacion de la ciudad XD
    center: [ - 3.2598522, - 79.9556159],
            zoom: 13
    }
    },
            marker: {
            values: [
                    //{
                    //puntos del gps a ingresar 

<?php
//$restaurente = new restaurante();
//$restaurente = $restaurente->Obtener_restaurante($_GET['rest_id']);
$restaurante='restaurante el gato';
$latDestino = '-3.478';
$lonDestino = '-80.2403';
?>
            {latLng: [<?php echo $latDestino ?>, <?php echo $lonDestino ?>], data: "hola"            ],
                    options: {
                    draggable: false
                    },
                    events: {
                    mouseover: function(marker, event, context) {
                    var map = $(this).gmap3("get"),
                            infowindow = $(this).gmap3({get: {name: "infowindow"}});
                            if (infowindow) {
                    infowindow.open(map, marker);
                            infowindow.setContent(context.data);
                    } else {
                    $(this).gmap3({
                    infowindow: {
                    anchor: marker,
                            options: {content: context.data}
                    }
                    });
                    }
                    },
                            mouseout: function() {
                            var infowindow = $(this).gmap3({get: {name: "infowindow"}});
                                    if (infowindow) {
                            infowindow.close();
                            }
                            }
                    }
            }
            });
            });</script>
<div class="col-xs-12 col-sm-12" id="contenedorII">

    <!-- <div class="jumbotron">

     </div>-->

    <div class="row">

        <table class="table table-hover">
            <tr>
                <td>
                    <!--presentacion de los comentarios-->
                    <div class="col-xs-2 ">
                        <!-- div para imagen-->
                        <?php
                        if ($restaurente->rest_urlfoto == "") {
                            ?>
                            <img src="<?php echo $categoria->cate_imagen ?>" width="80%" height="80%">
                            <?php
                        } else {
                            ?>

                            <img src="<?php echo $restaurente->rest_urlfoto ?>" width="80%" height="80%">

                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-xs-2 col-lg-8">
                        <h3><p class="text-uppercase"><a href="#" onclick="cargar('#contenedorII', 'app/gui/restaurante/cliente/info_detallada.php?rest_id=<?php echo $restaurente->rest_id ?>')"><?php echo $restaurente->rest_nombre ?></a></p></h3>
                        <p><a href="#" onclick="cargar('#contenedorII', 'app/gui/categoria/cliente/categoria.php?cate_id=<?php echo $restaurente->cate_id ?> ')"><font color="orange">
                                <?php
                                echo '' . $categoria->cate_nombre;
                                ?> 
                                </font>
                            </a>
                        </p>
                        <p><?php echo $restaurente->rest_direccion ?> </p>
                    </div>
                    <div class="col-xs-2">
                        <!-- div para puntaje-->
                        <br>
                        <p>Calificación</p>
                        <p><?php obtener_estrella($res->Obtener_Puntuacion_Restaurante($restaurente->rest_id)); ?></p>
                        <!--<p><a href="#" onclick="cargar('#contenedorII', 'app/gui/comentario/cliente/listar_comentarios.php?rest_id=<?php echo $restaurente->rest_id ?>')"><span class="glyphicon glyphicon-comment" aria-hidden="true"> Comentarios <span></a></p>-->
                    </div>
                    <!--fin de comentarios de Restaurantes-->
                </td>
            </tr>
        </table>
        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Información</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Comentarios ( <?php echo $plato->contar_comentarios($_GET['rest_id']) ?> )</a></li>
            <li role="presentation"><a href="#platos" aria-controls="platos" role="tab" data-toggle="tab">Platos ( <?php echo $plato->contar_platos_x_restaurant($_GET['rest_id']) ?> )</a></li>
            <li role="presentation" class="active"><a href="#llegar" aria-controls="llegar" role="tab" data-toggle="tab">¿Como llegar?</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane " id="home">
                            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                

            </div>
            <div role="tabpanel" class="tab-pane" id="platos">
                <!--Creacion de la tabla para visualizar el los mejores-->
                 <?php
                        
                        if ($_SESSION['usua_id'] != 0) {
                            ?>
                <a class="btn btn-lg btn-primary btn-block" href="#" onclick="cargar('#contenedorII', 'app/gui/restaurante/cliente/plato.php?rest_id=<?php echo $restaurente->rest_id ?>')">Crear Plato</a>
                        <?php } ?>
            </div>
            <div role="tabpanel" class="tab-pane active" id="llegar">
                <br>
                <table width="100%">
                    <th >
                    <td cellspan="3" width="100%" align="center"></td>
                    </th>
                    <tr>
                        <!-- <td align="right"><a href="#" onclick="cargar('#menuLateral', 'app/gui/menu_lateral/busquedad.php ')"> <img src="./images/glyphicons-6-car.png"> Automovil </span></a></td>-->
                        <td align="right">
                        <td>
                    <tr>
                    <a href="#" onclick="cargar('#llegar', 'app/gui/categoria/cliente/mapa/platos_ruta.php?rest_id=<?php echo $_GET['rest_id']; ?>&tipo=A&lon=<?php echo $lonDestino; ?>&lat=<?php echo $latDestino; ?>')"> 
                        <button type="button" class="btn btn-default btn-lg">
                            <span > <img src="./images/glyphicons-6-car.png"> </span> Automovil
                        </button> 
                    </a>
                    </tr>
                    </td>
                    <td>
                    <tr>
                    <!--<a href="#" onclick="cargar('#llegar', 'app/gui/categoria/cliente/mapa/platos_ruta.php?rest_id=<?php echo $_GET['rest_id']; ?>&tipo=B&lon=<?php echo $lonDestino; ?>&lat=<?php echo $latDestino; ?>')"> 
                        <button type="button" class="btn btn-default btn-lg">
                            <span > <img src="./images/glyphicons-307-bicycle.png"> </span> Bicicleta
                        </button> 
                    </a>-->
                    </tr>
                    </td>
                    <td>
                    <tr>
                    <a href="#" onclick="cargar('#llegar', 'app/gui/categoria/cliente/mapa/platos_ruta.php?rest_id=<?php echo $_GET['rest_id']; ?>&tipo=C&lon=<?php echo $lonDestino; ?>&lat=<?php echo $latDestino; ?>')"> 
                        <button type="button" class="btn btn-default btn-lg">
                            <span > <img src="./images/glyphicons-563-person-walking.png"> </span> Caminando
                        </button> 
                    </a>

                    </tr>
                    </td>
                    </td>
                    <td align="right"></td>
                    <td align="right"></td>
                    </tr>    
                </table>

                <div class="gmap3" id="test1" style="text-align:center;">
                </div>
            </div>
        </div><!--/.col-xs-12.col-sm-9-->


    </div><!--/row-->