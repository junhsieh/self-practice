<html>
<head>
  <link rel="stylesheet" type="text/css" href="/javascript/jquery-ui/jquery-ui-1.11.4/jquery-ui.min.css" />
  <script src="https://maps.googleapis.com/maps/api/js"></script>
  <script src="/javascript/google_map/markerclusterer_compiled.js"></script>
  <script src="/javascript/jquery-ui/jquery-ui-1.11.4/external/jquery/jquery.js"></script>
  <script src="/javascript/jquery-ui/jquery-ui-1.11.4/jquery-ui.min.js"></script>
  <script>
    var myMap = {
      map: null,
      markerArr: [],
      mapCenter: null,
    };

    $(document).ready(function(){
      $('#myDialogDiv').dialog({
        title: 'test Google Map API',
        autoOpen: false,
        resizable: true,
        draggable: true,
        show: {effect: 'drop', direction: "left"},
        hide: 'slide',
        position: "right bottom",
        width: 800,
        height: 500,
        resizeStop: function (event, ui) {
          google.maps.event.trigger(myMap.map, 'resize');
        },
        open: function (event, ui) {
          google.maps.event.trigger(myMap.map, 'resize');
        },
      });

      $('#showMapBtn').on('click', function(e){
        e.preventDefault();

        $.getJSON('/javascript/google_map/example/jquery_dialog/jquery_dialog_data.php', [], function(response) {
          myMap.setAllMarkers(response);

          $('#myDialogDiv').dialog('open');
        });
      });

      myMap.init = function(optObj) {
        if (!myMap.map) {
          myMap.map = new google.maps.Map(document.getElementById(optObj.mapDiv), {
            zoom: optObj.mapZoom,
            center: optObj.mapCenter,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
          });
          myMap.mapCenter = optObj.mapCenter;
        }
      }

      // Add a marker to the map and push to the array.
      myMap.addMarker = function(optObj) {
        var marker = new google.maps.Marker({
          map: myMap.map,
          position: new google.maps.LatLng(optObj.lat, optObj.lng),
        });

        myMap.markerArr.push(marker);
      }

      // Removes the markers from the map, but keeps them in the array.
      myMap.clearAllMarkers = function() {
        for (var i = 0; i < myMap.markerArr.length; i++) {
          myMap.markerArr[i].setMap(null);
        }
      }

      // Deletes all markers in the array by removing references to them.
      myMap.deleteAllMarkers = function() {
        myMap.clearAllMarkers();
        myMap.markerArr = [];
      }

      myMap.setAllMarkers = function(dataArr) {
        myMap.clearAllMarkers();

        for (var i = 0; i < dataArr.length; i++) {
          myMap.addMarker({lat: dataArr[i].lat, lng: dataArr[i].lng});
        }
      }

      myMap.init({
        mapDiv: 'myMapDiv',
        mapZoom: 3,
        mapCenter: new google.maps.LatLng(57.4519, -162.1419),
      });
    });
  </script>
</head>
<body>
  <a id="showMapBtn" href="">Show Map</a>

  <div id="myDialogDiv" style="display: none;">
    <div id="myMapDiv" style="width: 700px; height: 400px;"></div> 
  </div>
</body>
</html>

