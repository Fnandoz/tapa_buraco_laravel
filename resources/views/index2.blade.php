<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Info windows</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBhsjvabUuDHzH667B7e9YRTdPEW8U_iF4&sensor=false" type="text/javascript"></script>

    <script type="text/javascript">
      var locations = Object.values(<?php echo json_encode($buracos); ?>);

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11.47,
        center: new google.maps.LatLng(-1.3631285, -48.4657668),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      var markers = [];

      for (var buraco in locations) {
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(parseFloat(locations[buraco].lat), parseFloat(locations[buraco].lon)),
        map: map
        });

        markers.push(marker);

        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
          return function() {
            infowindow.setContent('<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">'+locations[buraco].descricao+'</h1>'+
            '<div id="bodyContent">'+
            '<p>Impacto: '+locations[buraco].impacto+'</p>'+
            '<img src="https://firebasestorage.googleapis.com/v0/b/tapa-buraco-256ba.appspot.com/o/'+locations[buraco].imagem+'?alt=media&token=1550f920-f361-41c1-8457-8b9bc5ac26d8" alt="Buraco" width="150" height="150">'+
            '</div>'+
            '</div>');
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
      console.log(markers[0]);


    </script>

  </body>
</html>
