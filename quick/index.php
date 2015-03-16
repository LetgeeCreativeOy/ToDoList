<?php

require_once "persona.php";

$body = $email = NULL;
if (isset($_POST['assertion'])) {
    $persona = new Persona();
    $result = $persona->verifyAssertion($_POST['assertion']);
    if ($result->status === 'okay') {
        $body = "<p>Logged in as: " . $result->email . "</p>";
        $body .= '<p><a href="javascript:navigator.id.logout()">Logout</a></p>';
        $email = $result->email;
    } else {
        $body = "<p>Error: " . $result->reason . "</p>";
        $body .= "<script>navigator.id.logout();</script>";
    }
    //$body .= "<p><a href=\"testPersona.php\">Back to login page</a></p>";
//} elseif (!empty($_GET['logout'])) {
    //$body = "<p>You have logged out.</p>";
    //$body .= "<p><a href=\"index.php\">Back to login page</a></p>";
} else {
    $body = "<p><a class=\"persona-button\" href=\"javascript:navigator.id.request()\"><span>Login with Persona</span></a></p>";
}
?><html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/persona-buttons.css">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
        

        <script>

        function initialize() {

          var markers = [];
          var map = new google.maps.Map(document.getElementById('map-canvas'), {
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });

          var defaultBounds = new google.maps.LatLngBounds(
              new google.maps.LatLng(-33.8902, 151.1759),
              new google.maps.LatLng(-33.8474, 151.2631));
          map.fitBounds(defaultBounds);

          var input = /** @type {HTMLInputElement} */(
              document.getElementById('pac-input')
          );
          //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          var searchBox = new google.maps.places.SearchBox((input));

          google.maps.event.addListener(searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
              return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
              marker.setMap(null);
            }

            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
              var image = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
              };

              // Create a marker for each place.
              var marker = new google.maps.Marker({
                map: map,
                icon: image,
                title: place.name,
                position: place.geometry.location
              });

              markers.push(marker);

              bounds.extend(place.geometry.location);
            }

            map.fitBounds(bounds);
          });

          google.maps.event.addListener(map, 'bounds_changed', function() {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);
          });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>

    <body>
        <div id="top">
            <form id="login-form" method="POST" action="index.php">
              <input id="assertion-field" type="hidden" name="assertion" value="">
            </form>
            <?php echo $body ?>
            
            <script src="https://login.persona.org/include.js"></script>
            <script>
            navigator.id.watch({
                loggedInUser: <?php echo $email ? '$email' : 'null' ?>,
                onlogin: function (assertion) {
                    var assertion_field = document.getElementById("assertion-field");
                    assertion_field.value = assertion;
                    var login_form = document.getElementById("login-form");
                    login_form.submit();
                },
                onlogout: function () {
                    window.location = '?logout=1';
                }
            });
            </script>
        </div>
        <div id="body">
            <div id="map-canvas">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15836.877695411353!2d24.065788046533207!3d60.25337397510201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfi!2sfi!4v1423140897204" width="100%" height="100%" frameborder="0" style="border:0">
                </iframe> -->
            </div>
            <div id="right_panel">

                <div id="dropbown"><input id="pac-input" class="controls" type="text" placeholder="Search Box"></div>

                <div id="list">
                    <p>Newest todo's, limited by above, only title</p>

                    <div id="todo" style="float:left">Something</div>
                    <div id="todo" style="float:right">Something</div>
                    <div id="todo" style="float:left">Something </div>
                    <div id="todo" style="float:right">Something</div>

                </div>
            </div>
        </div>
    </body>
</html>
