      var customLabel = {
        paneau: {
          label: 'Pn'
        },
        plaque: {
          label: 'Plq'
        },
        abrisdebus: {
          label: 'Abs'
        }
      };

      var listMarkers = new Array();

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(36.72147601457459, 3.088614445507801),
          zoom: 3
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

          // Change this depending on the name of your PHP or XML file
          downloadUrl('dataMap/data.xml', function(data) {
              var xml = data.responseXML;
              var markers = xml.documentElement.getElementsByTagName('marker');
              Array.prototype.forEach.call(markers, function(markerElem) {
                  var id = markerElem.getAttribute('id');
                  var name = markerElem.getAttribute('name');
                  
                  var type = markerElem.getAttribute('type');
                  var point = new google.maps.LatLng(
                      parseFloat(markerElem.getAttribute('lat')),
                      parseFloat(markerElem.getAttribute('lng')));

                  var infowincontent = document.createElement('div');
                  var strong = document.createElement('strong');
                  strong.textContent = name
                  infowincontent.appendChild(strong);
                  infowincontent.appendChild(document.createElement('br'));

                 
                  var icon = customLabel[type] || {};
                  var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    icon:'https://icons.iconarchive.com/icons/icons-land/vista-map-markers/48/Map-Marker-Marker-Outside-Azure-icon.png',
                    label: icon.label,
                    id: id,
                    name: name
                  });
                  listMarkers.push(marker);
                  marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                  });

                  //supprimer marker
                  marker.addListener("dblclick", function() {
                    //document.getElementById("markerSupp").innerHTML="Vous allez supprimer le marker "+"<b>"+marker.name+"</b>";
                    //$('#idSubmit').val(marker.id);
                    $('#delMark').val(marker.id);
                    var id = "#myModalsupp"+marker.id;
                    $(id).modal('show');
                  });

              });
          });

/*********************************************Add Marker******************************************/
    var image = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|00D900'
    //notez la présence de l'argument "event" entre les parenthèses de "function()"
    google.maps.event.addListener(map, 'click', function(event) {
      var newMarker = new google.maps.Marker({
        position: event.latLng,//coordonnée de la position du clic sur la carte
        map: map,//la carte sur laquelle le marqueur doit être affiché
        icon:'https://icons.iconarchive.com/icons/icons-land/vista-map-markers/48/Map-Marker-Marker-Outside-Chartreuse-icon.png',
      });
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();

      newMarker.addListener("dblclick", function() {
        newMarker.setMap(null);
      });

      $('#myModal').modal('show');
      document.getElementById("coordonees").innerHTML="Lat : "+lat+"&nbsp &nbsp &nbsp"+"Lng : "+lng;
      $('#lat').val(lat);
      $('#lng').val(lng);
      $('#nomM').val(null);
      $('#typeM').val(null);
    });

/*****************************************Fin Add Marker*******************************************/

// *****************************Geolocalisation********************************
       // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }  
// **************************FIN Geolocalisation********************************


        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers1 = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers1.
          markers1.forEach(function(marker) {
            marker.setMap(null);
          });
          markers1 = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers1.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

      } //**************************** FIN INIT() *************************

      // Fct geolocalisation
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }// fin fct geolocalisation

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;
        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
      };
        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}

      function setNull(id)
      {
          listMarkers.forEach(function(markerE) {
            if (markerE.id == id) { markerE.setMap(null);}
          });
      }
