<!DOCTYPE html>
 <html>
   <body>
     <head>
       <ul id="nav-mobile" class="sidenav sidenav-fixed" style="transform: translateX(0px);">
        <li class="logo"><a id="logo-container" href="/" class="brand-logo">Tapa Buraco
        <li class="search">
          <div class="search-wrapper">
            <input id="search" placeholder="Search"><i class="material-icons">search</i>
            <div class="search-results"></div>
          </div>
        </li>
        <li class="no-padding">
          <ul class="collection" id="lista"></ul>
          </ul>
        </li>
      </ul>
     </head>
     <main>
       <div class="container">
         aa
         <div id="heatmapContainer"></div>
       </div>
     </main>
     <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
     <!-- Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
     <script src="/js/heatmap.js"></script>
     <script src="/js/gmaps-heatmap.js"></script>

     <script type="text/javascript">
       var dados = Object.values(<?php echo json_encode($buracos); ?>);

       for (var i = 0; i < dados.length; i++) {
         var t = "<li class=\"collection-item avatar\"><img src=\"https://firebasestorage.googleapis.com/v0/b/tapa-buraco-256ba.appspot.com/o/"+dados[i].imagem+"?alt=media&token=1550f920-f361-41c1-8457-8b9bc5ac26d8\" class=\"circle\"><span class=\"title\"></span><p>"+dados[i].descricao+"<br>Impacto: "+dados[i].impacto+"</p><a href=\"#!\" class=\"secondary-content\"></a></li>";
         $('#lista').append(t);

       }
     </script>
     <script>
     /**
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
**/

  </script>
  <script>
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
