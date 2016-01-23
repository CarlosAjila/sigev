<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
function conectar_servidor()
{
	$hostname_conexion = "localhost";
	$username_conexion = "root";
	$password_conexion = "";
	$conexion = mysqli_connect($hostname_conexion, $username_conexion, $password_conexion,"bd_sigev") or trigger_error(mysql_error(),E_USER_ERROR); 
	return $conexion;
}

function ejecutar_sentencia($query)
{
	$conectar=conectar_servidor();
	$rs_resultado=mysqli_query($conectar,$query);
	mysqli_close($conectar);
	return $rs_resultado;
}
$rs_localidades=ejecutar_sentencia("SELECT paciente.id_pac,paciente.oex_pac,paciente.fre_pac,paciente.cas_pac,paciente.dir_pac,paciente.ref_pac,paciente.ofi_pac,
paciente.dof_pac,paciente.emi_pac,paciente.fat_pac,paciente.fis_pac,georeferenciacion.lon_geo,georeferenciacion.lat_geo,persona.pno_per,persona.apa_per,persona.te1_per,persona.te2_per,enfemedad.nom_enf,enfemedad.ima_enf,enfemedad.pri_enf
FROM georeferenciacion,paciente,persona,enfemedad,paciente_enfermedad
WHERE paciente.id_per=persona.id_per AND paciente.id_geo=georeferenciacion.id_geo 
AND paciente.id_pac=paciente_enfermedad.id_pac AND paciente_enfermedad.id_enf=enfemedad.id_enf AND paciente.est_pac='A'");//Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
$localidad=mysqli_fetch_assoc($rs_localidades);//Mediante esta línea en la variable $localidad recibimos un arreglo con el resultado de la consulta

$rs_barrios=ejecutar_sentencia("SELECT * FROM barrio");
$barrios=mysqli_fetch_assoc($rs_localidades);//Lista de barrios del cantón

?>
<script type="text/javascript">
var map,markers,longitu,latitu;
var osmLayer = new OpenLayers.Layer.OSM("OpenStreetMap");//Indicamos que capa queremos visualizar en este caso "OSM"
var proj4326 = new OpenLayers.Projection("EPSG:4326");//European Petroleum Survey Group (EPSG),se usa 4326 por que hace alución a WGS84, el mismo que es un sistema de coordenadas geográfico mundial que permite ubicar o localizar cualquier punto en la tierra
var projmerc = new OpenLayers.Projection("EPSG:900913");//Es una proyección esférica de mercator(es una proyección cartográfica cilindrica) y 900913 es por que esta fue creada por openstreetmap
var zoom = 14, id=0, hisoclick=0, lalatitud='', lalongitud='', lalatitud1='' , lalongitud1='', lon2='',lat2='',t_ida='car/Shortest';
var points1 = [], point, epsg4326, center, vectors, latitud_enviar='',longitud_enviar='',icon='',icon1='',mar=0, mar1=0;
function init()
{
	var lonlat = new OpenLayers.LonLat(-79.95232, -3.45889);//Establecemos la ubicación en el mapa

	map = new OpenLayers.Map("map", {
		controls: [
					new OpenLayers.Control.Navigation(),//Control que permite manipular el mapa a través del mouse
					new OpenLayers.Control.PanZoomBar(),//Control para visualizar la regla de zoom
				  ],
		maxExtent: new OpenLayers.Bounds(-180, -90, 180, 90),//Estos parámetros hacen alusión a la extención completa del mundo en grados
		maxResolution: "auto",
		units: 'm',
		projection: projmerc,
		displayProjection: proj4326
	} );


	map.addLayer(osmLayer);
	lonlat.transform(proj4326, projmerc);
	map.events.register("mousemove", map, mouseMoveHandler);
	map.setCenter(lonlat, zoom);
	<?php do{?>
	var nombre="<?php echo $localidad['pno_per']?>";
	var apellido="<?php echo $localidad['apa_per']?>";
	var enfermedad="<?php echo $localidad['nom_enf']?>";
	var caso="<?php echo $localidad['cas_pac']?>";
	var fecha_registro="<?php echo $localidad['fre_pac']?>";
	var direccion="<?php echo $localidad['dir_pac']?>";
	var referencia="<?php echo $localidad['ref_pac']?>";
	var te1="<?php echo $localidad['te1_per']?>";
	var te2="<?php echo $localidad['te2_per']?>";
	var ima="<?php echo $localidad['ima_enf']?>";
	var prioridad="<?php echo $localidad['pri_enf']?>";
	if(te1=="")	
	{
		te1="No posee";
	}
	if(te2=="")	
	{
		te2="No posee";
	}
	recibe(<?php echo $localidad['lat_geo']?>,<?php echo $localidad['lon_geo']?>,nombre,apellido,enfermedad,caso,fecha_registro,direccion,referencia,te1,te2,ima,prioridad);
	<?php }while($localidad=mysqli_fetch_assoc($rs_localidades));?>
	//Ubicando un marcador al momento de dar click sobre el mapa
	//Asignación de la capa especial para la ubicación de los marcadores a través de OpenLayers.Layer.Markers
    var marcador_nuevo = new OpenLayers.Layer.Markers("Marcador_Nuevo");
	//Asignamos un identificador a la nueva capa de marcador
	marcador_nuevo.id="Marcador_Nuevo";
	//Añadimos el nuevo marcador a nuestro mapa principal
	map.addLayer(marcador_nuevo);
		
	function transformToWGS84( sphMercatorCoords) 
	{
		// Transforma desde SphericalMercator a WGS84
		// Devuelve un OpenLayers.LonLat con el pto transformado
		var clon = sphMercatorCoords.clone();
		var pointWGS84= clon.transform(new OpenLayers.Projection("EPSG:900913"),new OpenLayers.Projection("EPSG:4326"));
		return pointWGS84;
	}
	
	function transformMouseCoords(lonlat) 
	{
		var newlonlat=transformToWGS84(lonlat);
		longitu = Math.round(newlonlat.lon*10000)/10000;
		latitu = Math.round(newlonlat.lat*10000)/10000;
		$("#longitud").val(longitu); 
		$("#latitud").val(latitu); 
	}
	
	function mouseMoveHandler(e) 
	{
		var position = this.events.getMousePosition(e);
		var lonlat = map.getLonLatFromPixel(position);
		transformMouseCoords(lonlat);
	}
}

//FUNCION PARA CALCULAR LA UBICACIÓN 
function ubicacion()
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(function(position){
		longitud_enviar=position.coords.longitude;
		latitud_enviar=position.coords.latitude;
		this.center = new OpenLayers.LonLat(longitud_enviar,latitud_enviar).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));
		/*Ubicar icono*/
		markers = new OpenLayers.Layer.Markers( "Markers" );
		map.addLayer(markers);
		var icon = new OpenLayers.Icon('../../imagenes/per.png');
		/*Fin ubicar icono*/
		markers.addMarker(new OpenLayers.Marker(this.center.transform(map),icon));
		map.setCenter(this.center.transform(map.proj4326, map.projmerc), 16);
		});
		marcador(longitud_enviar,latitud_enviar,1,0);
	}
}

function registrar_paciente()
{
	$('#dialogoformulario').dialog('open');
}

//funcion para registrar un paciente
function nuevo_paciente(ban)
{
	if(ban==1)
	{
	  map.events.register("click",map,function(e){
		  var position = map.getLonLatFromPixel(e.xy);
		  var size = new OpenLayers.Size(21,25);
		  var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
		  var icon = new OpenLayers.Icon('imagenes/casa.png', size, offset);   
		  var markerslayer = map.getLayer('Marcador_Nuevo');
  
		  markerslayer.addMarker(new OpenLayers.Marker(position,icon));
		  
		  position.transform(projmerc,proj4326);
		  latitu = Math.round(position.lat*10000)/10000;
		  longitu = Math.round(position.lon*10000)/10000;           
		  $('#longitud').val(longitu);
		  $('#latitud').val(latitu);
		  registrar_paciente();
		  //return false;
	  });
	}
}

//FUNCION PARA ESTABLECER UN PUNTO DE PARTIDA
function nuevo_marcador(ban)
{
	if(ban==1)
	{
	map.events.register("click", map, function(e) {//registra el evento click para la ubicación de un marcador
         var position = map.getLonLatFromPixel(e.xy);
		  var size = new OpenLayers.Size(21,25);
		  var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
		  var icon = new OpenLayers.Icon('imagenes/casa.png', size, offset);   
		  var markerslayer = map.getLayer('Marcador_Nuevo');
  
		  markerslayer.addMarker(new OpenLayers.Marker(position,icon));
		  
		  position.transform(projmerc,proj4326);
		  latitud_enviar = Math.round(position.lat*10000)/10000;
		  longitud_enviar = Math.round(position.lon*10000)/10000;           
		  marcador(longitud_enviar,latitud_enviar,1,0);
        });
	}
	
}

//PARA PRESENTACIÓN DEL MARCADOR TANTO DE INICIO COMO DE FIN
function marcador(longi, lati, tipo, buscaq)
{
	this.center = new OpenLayers.LonLat(longi, lati);
	markers = new OpenLayers.Layer.Markers( "Markers" );
	map.addLayer(markers);
	icon = new OpenLayers.Icon('../../imagenes/per.png');
	icon1 = new OpenLayers.Icon('../../imagenes/per.png');
	  if(tipo==1)
	  {		
		  if (hisoclick==1)
		  {
	  	  		markers.addMarker(new OpenLayers.Marker(this.center.clone().transform(proj4326, map.getProjectionObject()), icon));
		  }
		  else
		  {	
		  		var marker = new OpenLayers.Marker(this.center.transform(map), icon);
		  		markers.addMarker(marker);				
		   		if( mar==0)
		   		{
			   		map.setCenter(this.center.transform(map.displayProjection, map.projection), 16);
					mar=1;
		   		}
		   		else
		   		{    
					map.setCenter(this.center.transform(map.displayProjection, map.projection), 16);
					mar=0;
		   		}
		  }
		  lalongitud=longi;
		  lalatitud=lati;
	  }
	  if(tipo==2)
	  {	
		  if (hisoclick==1)
		  {markers.addMarker(new OpenLayers.Marker(this.center.clone().transform(proj4326, map.getProjectionObject()), icon1));}
		  else
		  {
			  var marker = new OpenLayers.Marker(this.center.transform(map), icon1);
			  markers.addMarker(marker);
			   if( mar1==0)
			   {
				map.setCenter(this.center.transform(map.displayProjection, map.projection), 16);
				mar1=1;
			   }
			   else
			   {    
				map.setCenter(this.center.transform(map.displayProjection, map.projection), 16);
				mar1=0;
			   }
		  }
		lalongitud1=longi;
		lalatitud1=lati;
	  }	
					
					
}	

function buscar(longitud_caso,latitud_caso)
{
	lon2=longitud_caso;
	lat2=latitud_caso;
	center=new OpenLayers.LonLat(lon2,lat2).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));//se transforma las coordenas a wgs84
	map.setCenter(center, 17);//se centra el mapa y se aplica un zoom de 16
}

/*Muestra Información en los popup*/
function recibe(longitud,latitud,nombre,apellido,enfermedad,caso,fecha_registro,direccion,referencia,te1,te2,ima,prioridad)
{
	center=new OpenLayers.LonLat(longitud,latitud).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));//se transforma las coordenas a wgs84
	map.setCenter(center, 13);//se centra el mapa y se aplica un zoom de 16
		//Asignación de la capa especial para la ubicación de los marcadores a través de OpenLayers.Layer.Markers
    	var marcador = new OpenLayers.Layer.Markers('MARCADOR');
		//Asignación de una imagen para el marcador a través de OpenLayers.Icon
		var icon = new OpenLayers.Icon(ima);
		//A través de marcador.addMarker añadimos un nuevo marcador a la capa previamente establecida para los marcadores denominada marcador
		marcador.addMarker(new OpenLayers.Marker(
    	new OpenLayers.LonLat(longitud,latitud).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913")),icon));
		//Finalmente añadimos la capa de marcadores al mapa principal, se ubica addLayers cuando interactuamos con más de una capa	
		map.addLayers([osmLayer,marcador]);
	
	//Mediante marcador.events.register 'mousedown', indicamos que capture el evento de click sobre cualquiera de los marcadores ubicados en la capa marcador.
	marcador.events.register('mousedown', marcador, function(evt) {
	//alert('Hola');
	map.addPopup(new  OpenLayers.Popup.FramedCloud("POPUP", 
		new OpenLayers.LonLat(longitud,latitud).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913")),//Este parámetro corresponde a la ubicación en el mapa
		null,//Tamaño de la ventana emergente
		"<table class='tablapopup'><tr><td align='center' colspan='2' style='font-weight:bold; background-color:#036; color:#FFF;'>Información de Paciente</td></tr><tr><td style='font-weight:bold;'>Paciente:</td><td>"+nombre+" "+apellido+"</td></tr><tr><td style='font-weight:bold;'>Enfermedad:</td><td>"+enfermedad+"</td></tr><tr><td style='font-weight:bold;'>Tipo de caso:</td><td>"+caso+"</td></tr><tr><td style='font-weight:bold;'>Fecha de registro:</td><td>"+fecha_registro+"</td></tr><tr><td style='font-weight:bold;'>Dirección domicilio:</td><td>"+direccion+"</td></tr><tr><td style='font-weight:bold;'>Referencia domicilio:</td><td>"+referencia+"</td></tr><tr><td style='font-weight:bold;'>Teléfono 1:</td><td>"+te1+"</td></tr><tr><td style='font-weight:bold;'>Teléfono 2:</td><td>"+te2+"</td></tr><tr><td style='font-weight:bold;'>Prioridad:</td><td>"+prioridad+"</td></tr></table>",//Contenido HTML
		null,
		true/*Esto nos indica que se mostrará una X en el popup para cerrarse*/));
	});
	
}

function trabajo_campo(longitud_caso,latitud_caso,id_pac)
{
	lon2=longitud_caso;
	lat2=latitud_caso;
	center=new OpenLayers.LonLat(lon2,lat2).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));//se transforma las coordenas a wgs84
	map.setCenter(center, 13);//se centra el mapa y se aplica un zoom de 16
	if((lon2!=0)||(lat2!=0))
	{
		//Asignación de la capa especial para la ubicación de los marcadores a través de OpenLayers.Layer.Markers
    	var marcador = new OpenLayers.Layer.Markers('MARCADOR');
		//Asignación de una imagen para el marcador a través de OpenLayers.Icon
		var icon = new OpenLayers.Icon('../../imagenes/per.png');
		//A través de marcador.addMarker añadimos un nuevo marcador a la capa previamente establecida para los marcadores denominada marcador
		marcador.addMarker(new OpenLayers.Marker(
    	new OpenLayers.LonLat(lon2,lat2).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913")),icon));
		//Finalmente añadimos la capa de marcadores al mapa principal, se ubica addLayers cuando interactuamos con más de una capa	
		map.addLayers([osmLayer,marcador]);
	
	//Mediante marcador.events.register 'mousedown', indicamos que capture el evento de click sobre cualquiera de los marcadores ubicados en la capa marcador.
	marcador.events.register('mousedown', marcador, function(evt) {
	//alert('Hola');
	$('#id_pac').val(id_pac);
	//$('#nombre_paciente').val(paciente);
	$('#dialogotrabajocampo').dialog('open');
	//map.addPopup(new  OpenLayers.Popup.FramedCloud("POPUP", 
		//new OpenLayers.LonLat(lon2,lat2).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913")),//Este parámetro corresponde a la ubicación en el mapa
		//null,//Tamaño de la ventana emergente
		//"<table width='200' border='1'><tr><td>Hola</td></tr></table>",//Contenido HTML
		//null,
		//true/*Esto nos indica que se mostrará una X en el popup para cerrarse*/));
	});
	marcador(lon2, lat2, 2, 0);
	}
	
}

//FUNCIÓN QUE PERMITE DIBUJAR LA RUTA
function drawLine(valor) { 
	
	if(valor == 1)//opcion para presentar el mapa de vigilante
		location.href="../mapa_vigilante.php?varlon="+ longitud_enviar + "&tipo=A&varlat="+latitud_enviar+"&lon="+lon2+"&lat="+lat2;	
	if(valor == 2)//opcion para presentar el mapa de vigilante
		location.href="../mapa3.php?varlon="+ longitud_enviar + "&tipo=A&varlat="+latitud_enviar+"&lon="+lon2+"&lat="+lat2;	
	if(valor == 3)//opcion para presentar el mapa de vigilante
		location.href="../mapa_estadistica.php?varlon="+ longitud_enviar + "&tipo=A&varlat="+latitud_enviar+"&lon="+lon2+"&lat="+lat2;	
}

//Funcion para editar el perfil
function editar_perfil()
{
	$('#dialogoperfil').dialog('open');
}

function barrios()
{
	alert('hola');
}
</script>

<script language="javascript">
$(document).ready(function(e) {
    $('#dialogoformulario').dialog({
		autoOpen:false,
		modal:true,
		width:850,
		height:600
	});
	$('#dialogotrabajocampo').dialog({
		autoOpen:false,
		modal:true,
		width:350,
		height:650
	});
	/*Dialogo para editar perfil*/
	$('#dialogoperfil').dialog({
		autoOpen:false,
		modal:true,
		width:790,
		height:510
	});
	$('#bt_guardar').click(function(e) {
		var ruta = "../../Contralador/Cgeoreferenciacion.php";	
		$.ajax({
			url:ruta,
			type:'POST',
			dataType:'json',
			data: $('#FormRegistroP').serialize(),
			success: function(json){
           		//Parseamos el array JSON
				alert(json.mensaje);
           	}
		});
    });
});
</script>
<script language="javascript">
$(document).ready(function(){
	$("select[name=barrio]").change(function(){
	var cordenadas=$('select[name=barrio]').val();
	var ss = cordenadas.split(",");
	buscar(ss[0],ss[1]);
	})
});
</script>

<div id="barriosflotante">
        <table class="tablabarrios" width="100%">
        <tr>
            <td align="center" style="background-color:#036; color:#FFF;">Barrios del Cantón Santa Rosa</td>
        </tr>
            <tr>
                <td align="center">
                    <select name="barrio" style="width:100%">
                        <option value="" selected="selected">Seleccione un barrio</option>
                    <?php do{?>
                        <option value="<?php echo $barrios['lon_bar']?>,<?php echo $barrios['lat_bar']?>"><?php echo $barrios['nom_bar']?></option>
                    <?php }while($barrios=mysqli_fetch_assoc($rs_barrios));?>
                    </select>
                </td>
            </tr>
        </table>
</div>

<div id="leyendaflotante">
<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormPuntos" id="FormPuntos" enctype="multipart/form-data">
    <table class="tablaleyenda">
        <tr>
            <td colspan="4" style="background-color:#036; color:#FFF;">Leyenda del mapa</td>
        </tr>
        <tr style="background-color:#FFF;">
            <td><img src="../../imagenes/chikungunya.png" /></td>
            <td><img src="../../imagenes/dengue.png" /></td>
            <td><img src="../../imagenes/paludismo.png" /></td>
            <td><img src="../../imagenes/zika.png" /></td>
        </tr>
        <tr style="background-color:#FFF;">
            <td width="80px">Chikungunya</td>
            <td width="80px">Dengue</td>
            <td width="80px">Paludismo</td>
            <td width="80px">Zika</td>
        </tr>
    </table>
</form>
</div>