<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>Googlemaps Heatmap Layer</title>
    <style>
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0; font-family:sans-serif; }
      #map-canvas { height: 100% }
      h1 { position:absolute; background:black; color:white; padding:10px; font-weight:200; z-index:10000;}
      #all-examples-info { position:absolute; background:white; font-size:16px; padding:20px; bottom:20px; width:350px; line-height:150%; border:1px solid rgba(0,0,0,.2);}
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="/js/heatmap.js"></script>
    <script src="/js/gmaps-heatmap.js"></script>
  </head>
  <body>
    <h1>Tapa Buraco</h1>
    <div id="map-canvas"></div>
    <div id="all-examples-info">
          <strong style="font-weight:bold;line-height:200%;font-size:18px;">Looking for more examples?</strong> <br />Check out the full <a href="http://www.patrick-wied.at/static/heatmapjs/examples.html?utm_source=gh_local" target="_blank">list of all heatmap.js examples</a> with more pointers &amp; inline documentation.
        </div>

    <script>
        // map center
        var myLatlng = new google.maps.LatLng(-1.4292069, -48.433406);
        // map options,
        var myOptions = {
          zoom: 12,
          center: myLatlng
        };
        // standard map
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
        // heatmap layer
        heatmap = new HeatmapOverlay(map,
          {
            // radius should be small ONLY if scaleRadius is true (or small radius is intended)
            "radius": 0.001,
            "maxOpacity": 0.8,
            // scales the radius based on map zoom
            "scaleRadius": true,
            // if set to false the heatmap uses the global maximum for colorization
            // if activated: uses the data maximum within the current map boundaries
            //   (there will always be a red spot with useLocalExtremas true)
            "useLocalExtrema": true,
            // which field name in your data represents the latitude - default "lat"
            latField: 'lat',
            // which field name in your data represents the longitude - default "lng"
            lngField: 'lng',
            // which field name in your data represents the data value - default "value"
            valueField: 'impacto'
          }
        );
        var testData = {
          max: 1,
          data: [{lat: -1.432151799826942, lng:-48.48115023225546, count: 5}, {lat:-1.3590517838332539, lng:-48.44308264553547, count: 10}]
        };

        heatmap.setData(testData);


</script>
<script>
  var dados = Object.values(<?php echo json_encode($array); ?>);
  for (var i = 0; i < dados.length; i++) {
    console.log(dados[i]);
    var img = "https://firebasestorage.googleapis.com/v0/b/tapa-buraco-256ba.appspot.com/o/"+dados[i].imagem+"?alt=media&token=1550f920-f361-41c1-8457-8b9bc5ac26d8"
    console.log(img);
  }

  // create configuration object
var config = {
  container: document.getElementById('heatmapContainer'),
  radius: 10,
  maxOpacity: .5,
  minOpacity: 0,
  blur: .75
};
// create heatmap with configuration
var heatmapInstance = h337.create(config);
</script>
  </body>
</html>
