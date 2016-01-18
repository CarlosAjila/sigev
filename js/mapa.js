
        var map;
        var centerWGS84, centerOSM;
        var projWGS84, projSphericalMercator;
        var osmLayer;
        
        function init(){

        	projWGS84 = new OpenLayers.Projection("EPSG:4326");
			projSphericalMercator = new OpenLayers.Projection("EPSG:900913");  
			
			centerWGS84=new OpenLayers.LonLat(-3.69357,40.41062);
			centerOSM = transformToSphericalMercator(centerWGS84);

			map = new OpenLayers.Map("map");
			
			osmLayer = new OpenLayers.Layer.OSM();

        	map.addLayer(osmLayer);
        	map.setCenter(centerOSM, 15);            
            map.events.register("mousemove", map, mouseMoveHandler);
            
            
        }
        function mouseMoveHandler(e) {
        	var position = this.events.getMousePosition(e);
        	var lonlat = map.getLonLatFromPixel(position);
            OpenLayers.Util.getElement("coords").innerHTML = transformMouseCoords(lonlat);
        }
        function transformMouseCoords(lonlat) {
        	var newlonlat=transformToWGS84(lonlat);
			var x = Math.round(newlonlat.lon*10000)/10000;
			var y = Math.round(newlonlat.lat*10000)/10000;
			newlonlat = new OpenLayers.LonLat(x,y);
			return newlonlat;
        }
        function transformToWGS84( sphMercatorCoords) {
        	// Transforma desde SphericalMercator a WGS84
        	// Devuelve un OpenLayers.LonLat con el pto transformado
        	var clon = sphMercatorCoords.clone(); // Si no uso un clon me transforma el punto original
        	var pointWGS84= clon.transform(
                    new OpenLayers.Projection("EPSG:900913"), // to Spherical Mercator Projection;
        			new OpenLayers.Projection("EPSG:4326")); // transform from WGS 1984
        	return pointWGS84;
        }
        function transformToSphericalMercator( wgs84LonLat) {
        	// Transforma desde SphericalMercator a WGS84
        	// Devuelve un OpenLayers.LonLat con el pto transformado
        	var clon = wgs84LonLat.clone(); // Si no uso un clon me transforma el punto original
        	var pointSphMerc= clon.transform(
                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                    new OpenLayers.Projection("EPSG:900913")); // to Spherical Mercator Projection;
        	return pointSphMerc;
        }
    

