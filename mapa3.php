<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js" type="text/javascript"></script>
<script src="js/ie10-viewport-bug-workaround.js"></script>
<script src="js/gmap3.js"></script>

 <?php
$lonOrigen=$_GET['varlon']; //origen
$latOrigen=$_GET['varlat']; //origen
$lonDestino=$_GET['lon'];//destino
$latDestino=$_GET['lat'];//destino
$tipo_ruta=$_GET['tipo']; //A en auto - C a pie
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

<!-- iniciemos el mapa-->
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
			<a href="mapa3.php?varlon=<?php echo $lonOrigen; ?>&varlat=<?php echo $latOrigen; ?>&tipo=A&lon=<?php echo $lonDestino; ?>&lat=<?php echo $latDestino; ?>" > 
				<button type="button" class="btn btn-default btn-lg">
					<span > <img src="./images/glyphicons-6-car.png"> </span> Automovil
				</button> 
			</a>
			</tr>
			</td>
			<td>
			<tr>
<!--			<a href="#" onclick="cargar('#llegar', 'app/gui/categoria/cliente/mapa/platos_ruta.php?rest_id=<?php echo $_GET['rest_id']; ?>&tipo=B&lon=<?php echo $lonDestino; ?>&lat=<?php echo $latDestino; ?>')"> 
				<button type="button" class="btn btn-default btn-lg">
					<span > <img src="./images/glyphicons-307-bicycle.png"> </span> Bicicleta
				</button> -->
			</a>
			</tr>
			</td>
			<td>
			<tr>
			<a href="mapa3.php?varlon=<?php echo $lonOrigen; ?>&varlat=<?php echo $latOrigen; ?>&tipo=C&lon=<?php echo $lonDestino; ?>&lat=<?php echo $latDestino; ?>" > 
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
<!--Fin del Mapa-->