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
      mapCenter: null,
      markerArr: [],
      markerClusterer: null,
      markerClusterOptions: {gridSize: 50, maxZoom: 8},
      infoWindow: null,
    };

    // Initializing Google Map
    myMap.init = function(optObj) {
      if (!myMap.map) {
        myMap.map = new google.maps.Map(document.getElementById(optObj.mapDiv), {
          zoom: optObj.mapZoom,
          center: optObj.mapCenter,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        });
        myMap.mapCenter = optObj.mapCenter;
        myMap.infoWindow = new google.maps.InfoWindow();
      }
    };

    // Add a marker to the map and push to the array.
    myMap.addMarker = function(optObj) {
      var marker = new google.maps.Marker({
        map: myMap.map,
        position: new google.maps.LatLng(optObj.lat, optObj.lng),
        icon: myMap.getIcon(optObj.salesDiff),
        dealerName: optObj.dealerName,
        salesDiff: optObj.salesDiff,
        lastInvoiceDate: optObj.lastInvoiceDate,
      });

      // mouseover
      google.maps.event.addListener(marker, 'mouseover', myMap.setInfoWindowContent_v2(myMap.infoWindow));

      // mouseout
      //google.maps.event.addListener(marker, 'mouseout', function(){
      //  myMap.infoWindow.close();
      //});

      // click
      google.maps.event.addListener(marker, 'click', function(){
        console.log($(this).attr('dealerName'));
      });

      myMap.markerArr.push(marker);

      // marker list div.
      var item = document.createElement('DIV');
      var title = document.createElement('A');
      title.href = '#';
      title.className = 'title';
      title.innerHTML = optObj.dealerName;

      item.appendChild(title);
      $('#markerListDiv').append(item);

      google.maps.event.addDomListener(title, 'click', myMap.setAllMarkerListItems({
        dealerName: optObj.dealerName,
        lat: optObj.lat,
        lng: optObj.lng,
      }));
    };

    // Add all markers.
    myMap.addAllMarkers = function(dataArr) {
      myMap.deleteAllMarkers();

      for (var i = 0; i < dataArr.length; i++) {
        myMap.addMarker({
          lat: dataArr[i].lat,
          lng: dataArr[i].lng,
          dealerName: dataArr[i].dealerName,
          salesDiff: dataArr[i].salesDiff,
          lastInvoiceDate: dataArr[i].lastInvoiceDate,
        });
      }

      myMap.markerCluster = new MarkerClusterer(myMap.map, myMap.markerArr, myMap.markerClusterOptions);
    };

    // Removes the markers from the map, but keeps them in the array.
    myMap.clearAllMarkers = function() {
      for (var i = 0; i < myMap.markerArr.length; i++) {
        myMap.markerArr[i].setMap(null);
      }
    };

    // Shows any markers currently in the array.
    myMap.showAllMarkers = function() {
      myMap.setAllMarkers();
    };

    // Sets the map on all markers in the array.
    myMap.setAllMarkers = function() {
      for (var i = 0; i < myMap.markerArr.length; i++) {
        myMap.markerArr[i].setMap(myMap.map);
      }
    };

    // Deletes all markers in the array by removing references to them.
    myMap.deleteAllMarkers = function() {
      if (myMap.markerCluster) {
        myMap.markerCluster.clearMarkers();
        myMap.markerCluster = null;
      }

      myMap.clearAllMarkers();
      myMap.markerArr = [];
    };

    myMap.setInfoWindowContent_v2 = function(infowindow) {
      return function() {
        var color = myMap.diffColor(this.salesDiff);

        myMap.infoWindow.setContent(''
          + '<b>' + this.dealerName + '</b>'
          + '<br>'
          + '<span style="color: ' + myMap.diffColor(this.salesDiff) + ';">'
            + '<b>Last 1M vs Last 2M Diff: ' + this.salesDiff + '</b>'
          + '</span>'
          + '<br>Last Invoice: ' + this.lastInvoiceDate
        );
        myMap.infoWindow.open(this.map, this);
      }
    };

    // Add listener to marker list items.
    myMap.setAllMarkerListItems = function(optObj) {
      return function(e) {
        e.cancelBubble = true;
        e.returnValue = false;
        if (e.stopPropagation) {
          e.stopPropagation();
          e.preventDefault();
        }

        var latLngObj = new google.maps.LatLng(optObj.lat + 0.004, optObj.lng);

        myMap.map.setCenter(latLngObj);
        myMap.map.setZoom(13);
        myMap.infoWindow.setContent(optObj.dealerName);
        myMap.infoWindow.setPosition(latLngObj);
        myMap.infoWindow.open(myMap.map);
      };
    };

    myMap.getIcon = function(num) {
      var iconURL = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=';
      var iconTxt = 'D';

      if (num > 0) {
        iconTxt = 'U';
      }

      return iconURL + iconTxt + '|' + myMap.diffColor(num) + '|000000';
    };

    // Get color by sales number.
    myMap.diffColor = function(num) {
      if (num > 0) {
        return '33CC00'; // green
      }
      else if (num == 0) {
        return '000000'; // black
      }
      else if (num >= -20) {
        return 'FF9933'; // orange
      }
      else {
        return 'FF0000'; // red
      }
    };

    $(document).ready(function(){
      $('#myDialogDiv').dialog({
        title: 'test Google Map API',
        autoOpen: false,
        resizable: true,
        draggable: true,
        show: {effect: 'drop', direction: "up"},
        hide: {effect: 'slide', direction: 'up'},
        width: 800,
        height: 500,
        resizeStop: function (event, ui) {
          // this line helps to prevent showing the incomplete map.
          google.maps.event.trigger(myMap.map, 'resize');
        },
        open: function (event, ui) {
          // this line helps to prevent showing the incomplete map.
          google.maps.event.trigger(myMap.map, 'resize');
        },
        close: function (event, ui) {
          $('#markerListDiv').html('');
        },
      });

      $('#showMapBtn').on('click', function(e){
        e.preventDefault();

        $.getJSON('/javascript/google_map/example/jquery_dialog/jquery_dialog_data.php', [], function(response) {
          myMap.addAllMarkers(response);

          $('#myDialogDiv').dialog('open');
        });
      });

      myMap.init({
        mapDiv: 'myMapDiv',
        mapZoom: 3,
        mapCenter: new google.maps.LatLng(57.4519, -162.1419),
      });
    });
  </script>
</head>
<body>
  <p>This example shows Google Maps JavaScript API inside of jQuery Dialog Window. If the map was not showing up incompletely, there are two important considerations here:</p>
  <ul>
    <li>1. Ensure that all the javascript/jQuery is included on the parent page. Don't try to deliver the js via AJAX.</li>
    <li>2. Ensure that the map is initialized only when the canvas is visible. Initializing an invisible canvas is only ever partially successful.</li>
  </ul>
  <p>A marker clustering library for the Google Maps JavaScript API v3:</p>
  <a href="https://github.com/googlemaps/js-marker-clusterer">https://github.com/googlemaps/js-marker-clusterer</a>

  <p><b>Reference:</b></p>
  <a href="http://stackoverflow.com/questions/16547779/google-maps-javascript-api-inside-of-jquery-dialog-window">http://stackoverflow.com/questions/16547779/google-maps-javascript-api-inside-of-jquery-dialog-window</a>


  <div id="panel" style="margin-top: 30px;">
    <input id="showMapBtn" type=button value="Show Map">
    <input onclick="myMap.clearAllMarkers();" type=button value="Hide Markers">
    <input onclick="myMap.showAllMarkers();" type=button value="Show Markers">
    <input onclick="myMap.deleteAllMarkers();" type=button value="Delete Markers">
  </div>

  <div id="markerListDiv"></div>

  <div id="myDialogDiv" style="display: none;">
    <div id="myMapDiv" style="width: 700px; height: 400px;"></div> 
  </div>
</body>
</html>

