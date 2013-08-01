function initialize() {
    var mapOptions = {
      center: new google.maps.LatLng(46.316584,2.83081),
      zoom: 5,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('map_canvas'),
      mapOptions);

    var input = document.getElementById('ville');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
      map: map,
      draggable: true
    });
    
    google.maps.event.addListener(marker, 'drag', function() {
      updateMarkerPosition(marker.getPosition());
    });

    google.maps.event.addListener(marker, 'dragend', function() {
      geocodePosition(marker.getPosition());
    });

    function updateMarkerPosition(latLng) {
      document.getElementById('lat').setAttribute("value",latLng.lat());
      console.log(latLng.lat());
      document.getElementById('lng').setAttribute("value",latLng.lng());
      console.log(latLng.lng());
    }

    function updateMarkerAddress(str) {
      document.getElementById('adresse_reelle').value = str;
    }
    var geocoder = new google.maps.Geocoder();
    function geocodePosition(pos) {
      geocoder.geocode({
        latLng: pos
      }, function(responses) {
        if (responses && responses.length > 0) {
          updateMarkerAddress(responses[0].formatted_address);
        } else {
          updateMarkerAddress('Cannot determine address at this location.');
        }
      });
    }
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      
      input.className = '';
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // Inform the user that the place was not found and return.
        input.className = 'notfound';
        return;
      }
      

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
      };
      marker.setIcon(image);
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);
      updateMarkerPosition(marker.getPosition());
      updateMarkerAddress(place.vicinity);
    });
  }
  google.maps.event.addDomListener(window, 'load', initialize);