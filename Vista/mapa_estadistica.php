<link rel="stylesheet" type="text/css" href="../Estilos/EstiloAdministrador.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js" type="text/javascript"></script>
<script src="../js/ie10-viewport-bug-workaround.js"></script>
<script src="../js/gmap3.js"></script>

 <?php
$lonOrigen=$_GET['varlon']; //origen
$latOrigen=$_GET['varlat']; //origen
$lonDestino=$_GET['lon'];//destino
$latDestino=$_GET['lat'];//destino
$tipo_ruta=$_GET['tipo']; //A en auto - C a pie
?>
<style>
    *{
	margin:0px auto;
	padding:0px;
	box-sizing:border-box;/*Para que todo se contenga dentro del mismo modelo de caja*/
	}
    .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        top:30px;
		left:0%;
		width:100%;
		height:92%;
		position:absolute;
    }
</style>
<script type="text/javascript">
          var origen = new google.maps.LatLng(<?php echo $latOrigen; ?> , <?php echo $lonOrigen ?>);
          var destino = new google.maps.LatLng(<?php echo $latDestino; ?> , <?php echo $lonDestino ?>);
          console.log(origen);
          console.log(destino);
      $(function(){
      $("#test1").gmap3({           
  getroute:{
    options:{
        origin: origen,
        destination:destino,
        <?php if($tipo_ruta=='A'){ ?>
        travelMode: google.maps.DirectionsTravelMode.DRIVING
        <?php }
        if($tipo_ruta=='B'){ ?>
        travelMode: google.maps.DirectionsTravelMode.BICYCLING
        <?php }
        if($tipo_ruta=='C'){ ?>
        travelMode: google.maps.DirectionsTravelMode.WALKING
        <?php } ?>
    },
    callback: function(results){
      if (!results) return;
      $(this).gmap3({
        map:{
          options:{
            center: [-3.2598522, -79.9556159],
                            zoom: 13
          }
        },
        directionsrenderer:{
          options:{
            directions:results
          } 
        }
      });
    }
  }
});
        
        });
</script>

<div id="contenedor">
    <header>
        <div class="contenedor">
            <h1><img src="../imagenes/lbanner-05.png" class="logo" /></h1>
            <input type="checkbox" id="menu-bar" />
            <label class="icon-menu" for="menu-bar"></label>
             
            <nav class="menu">
                <a href="Estadistica/Inicio.php" style="font-size:18px;" class="icon-inicio">Inicio</a>
            </nav>
        </div>
    </header>
<!-- iniciemos el mapa-->
<div class="gmap3" id="test1" style="text-align:center;">
</div>
<!--Fin del Mapa-->
</div>