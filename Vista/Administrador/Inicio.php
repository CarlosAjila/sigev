<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" href="../../Estilos/fontello.css" />
<title>SIGEV - Administrador</title>
</head>

<!--SECCIÓN PARA LA PRESENTACIÓN DEL MAPA-->
<script type="text/javascript" src="http://www.openlayers.org/api/OpenLayers.js"></script>
<!--Librerias para el uso de Jquery 1.11.3-->
<script src="jquery-1.11.3/jquery-1.11.3.js"></script>
<script type="text/javascript">
var map,longitu,latitu;
var osmLayer = new OpenLayers.Layer.OSM("OpenStreetMap");//Indicamos que capa queremos visualizar en este caso "OSM"
function init()
{
	var proj4326 = new OpenLayers.Projection("EPSG:4326");//European Petroleum Survey Group (EPSG),se usa 4326 por que hace alución a WGS84, el mismo que es un sistema de coordenadas geográfico mundial que permite ubicar o localizar cualquier punto en la tierra
	var projmerc = new OpenLayers.Projection("EPSG:900913");//Es una proyección esférica de mercator(es una proyección cartográfica cilindrica) y 900913 es por que esta fue creada por openstreetmap

	var lonlat = new OpenLayers.LonLat(-79.95232, -3.45889);//Establecemos la ubicación en el mapa
	var zoom = 14;

	var map = new OpenLayers.Map("map", {
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
	
	//Ubicando un marcador al momento de dar click sobre el mapa
	//Asignación de la capa especial para la ubicación de los marcadores a través de OpenLayers.Layer.Markers
    var marcador_nuevo = new OpenLayers.Layer.Markers("Marcador_Nuevo");
	//Asignamos un identificador a la nueva capa de marcador
	marcador_nuevo.id="Marcador_Nuevo";
	//Añadimos el nuevo marcador a nuestro mapa principal
	map.addLayer(marcador_nuevo);
	
	
	map.events.register("click",map,function(e){
		//var icon = new OpenLayers.Icon('imagenes/casa.png');//carga la imagen del marcador 
		//var lonlat = map.getLonLatFromPixel(e.xy) 
		var position = map.getLonLatFromPixel(e.xy);
      	var size = new OpenLayers.Size(21,25);
   		var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
		var icon = new OpenLayers.Icon('imagenes/casa.png', size, offset);   
   		var markerslayer = map.getLayer('Marcador_Nuevo');

   		markerslayer.addMarker(new OpenLayers.Marker(position,icon));
        
		position.transform(projmerc,proj4326);
        longitu = Math.round(position.lat*10000)/10000;
		latitu = Math.round(position.lon*10000)/10000;           
        alert(''+longitu);
	});
	
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
function mostrar_fondo() {
    //document.getElementById("fondo").style.display="block";
}
<!--FIN DE LA SECCIÓN PARA LA PRESENTACIÓN DEL MAPA-->

<!--Función para la presentación de la leyenda-->
function leyenda_dialog()
{
	
}

//FUNCION PARA CALCULAR LA UBICACIÓN 
function ubicacion()
{
	if (navigator.geolocation)
			{
                 navigator.geolocation.getCurrentPosition(function(position){
				   longitud_enviar=position.coords.longitude;
				   latitud_enviar=position.coords.latitude;
				   //alert ('longitud: '+longitud_enviar+'  latitud: '+latitud_enviar);
				   this.center = new OpenLayers.LonLat(longitud_enviar,latitud_enviar).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));
				   markers = new OpenLayers.Layer.Markers( "Markers" );
				  map.addLayer(markers);
				  var icon = new OpenLayers.Icon('img/per.png');
				  markers.addMarker(new OpenLayers.Marker(this.center.transform(map),icon));
				  map.setCenter(this.center.transform(map.proj4326, map.projmerc), 16);
				});
			}
			else
			{alert ('Su navegador no soporta geolocalizacion.!!');}	
			marcador(longiubi, latiubi, 1, 0);
}
</script>

<body onload="init()">
<header>
	<div class="contenedor">
    	<h1><img src="../../imagenes/lbanner-05.png" class="logo" /></h1>
        <input type="checkbox" id="menu-bar" />
        <label class="icon-menu" for="menu-bar"></label>
        <nav class="menu">
        	<a href="#" style="font-size:18px;" class="icon-inicio">Inicio</a>
            <a href="../Usuario/Listar.php" style="font-size:18px;" class="icon-iniciar-sesion">Usuarios</a>
            <a href="#" onclick="ubicacion()" style="font-size:18px;">Ubicacion</a>
        </nav>
    </div>
</header>
<div id="map"></div>
</body>
</html>