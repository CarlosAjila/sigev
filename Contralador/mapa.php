<script type="text/javascript">
var map,markers,longitu,latitu;
var osmLayer = new OpenLayers.Layer.OSM("OpenStreetMap");//Indicamos que capa queremos visualizar en este caso "OSM"
var proj4326 = new OpenLayers.Projection("EPSG:4326");//European Petroleum Survey Group (EPSG),se usa 4326 por que hace alución a WGS84, el mismo que es un sistema de coordenadas geográfico mundial que permite ubicar o localizar cualquier punto en la tierra
var projmerc = new OpenLayers.Projection("EPSG:900913");//Es una proyección esférica de mercator(es una proyección cartográfica cilindrica) y 900913 es por que esta fue creada por openstreetmap
var zoom = 14, id=0;
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
		  return false;
	  });
	}
}

</script>

<script language="javascript">
$(document).ready(function(e) {
    $('#dialogoformulario').dialog({
		autoOpen:false,
		modal:true,
		width:350,
		height:'auto'
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