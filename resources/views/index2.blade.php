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

    <script>
      var markers = Array();
      // This example displays a marker at the center of Australia.
      // When the user clicks the marker, an info window opens.

      var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

      function getDados() {
        var marcador = new google.maps.Marker({
          position: {lat: -25.363, lng: 131.044},
          map: map,
          title: 'Uluru (Ayers Rock)',
          icon: image
        });
        markers.push(marcador);
        markers.push(marcador);
        markers.push(marcador);
        markers.push(marcador);
      }

      function initMap() {
        getDados();
        var buracos = Object.values(<?php echo json_encode($buracos); ?>);

        var belem = {lat: -1.3631285, lng: -48.4657668};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11.47,
          center: belem
        });

        for (var buraco in buracos) {
          //console.log(buracos[buraco].descricao);
          var position = {lat: parseFloat(buracos[buraco].lat), lng: parseFloat(buracos[buraco].lon)};
          var marker = new google.maps.Marker({
            position: position,
            map: map,
            title: 'Uluru (Ayers Rock)'
          });
          google.maps.event.addListener(marker, 'click', (function(marker) {
           return function() {
               var content =
               '<div id="content">'+
               '<div id="siteNotice">'+
               '</div>'+
               '<h1 id="firstHeading" class="firstHeading">'+buracos[buraco].descricao+'</h1>'+
               '<div id="bodyContent">'+
               '<p>Impacto: '+buracos[buraco].impacto+'</p>'+
               '<img src="https://firebasestorage.googleapis.com/v0/b/tapa-buraco-256ba.appspot.com/o/'+buracos[buraco].imagem+'?alt=media&token=1550f920-f361-41c1-8457-8b9bc5ac26d8" alt="Buraco" width="150" height="150">'+
               '</div>'+
               '</div>';
               console.log('<h1 id="firstHeading" class="firstHeading">'+buracos[buraco].descricao+'</h1>');
               infowindow.setContent(content);
               infowindow.open(map, marker);
           }
         })(marker));

        }

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the '+
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
            'south west of the nearest large town, Alice Springs; 450&#160;km '+
            '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
            'features of the Uluru - Kata Tjuta National Park. Uluru is '+
            'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
            'Aboriginal people of the area. It has many springs, waterholes, '+
            'rock caves and ancient paintings. Uluru is listed as a World '+
            'Heritage Site.</p>'+
            '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '(last visited June 22, 2009).</p>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhsjvabUuDHzH667B7e9YRTdPEW8U_iF4&callback=initMap">
    </script>
  </body>
</html>
