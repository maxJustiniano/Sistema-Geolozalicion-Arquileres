<html><head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<style>
#map { position:absolute; top:20px; left:20px; width:95%; height:95%}
</style></head>
<body><div id="map"></div>
<script type="text/javascript">
var map;
var zoom = 3;
var argenmap = new L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
    minZoom: 1, maxZoom: 20
});

$(function () {
    map = new L.map('map', {
        center: new L.LatLng(-59.08574, -46.83348),
        zoom: zoom, zoomControl: true,
        layers: [argenmap]
    });
});
</script></body></html>