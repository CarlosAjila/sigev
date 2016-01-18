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
	map.setCenter(center, 13);//se centra el mapa y se aplica un zoom de 16
	if((lon2!=0)||(lat2!=0))
	{
		//marcador(lon2, lat2, 2, 0);
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
	alert('Hola');
	$('#id_pac').val(lon2);
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
function drawLine() { 
	location.href="../mapa3.php?varlon="+ longitud_enviar + "&tipo=A&varlat="+latitud_enviar+"&lon="+lon2+"&lat="+lat2;	
}
</script>

<script language="javascript">
$(document).ready(function(e) {
    $('#dialogoformulario').dialog({
		autoOpen:false,
		modal:true,
		width:350,
		height:750
	});
	$('#dialogotrabajocampo').dialog({
		autoOpen:false,
		modal:true,
		width:350,
		height:750
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