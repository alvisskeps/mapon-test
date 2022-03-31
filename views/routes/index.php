<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="map" style="height: 95vh;"></div>
<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 6,
            center: { lat: 56.9496, lng: 24.1052 },
        });

        const responseStatus = <?= $this->params['success'] ?>;

        if (!responseStatus) {
            const message = <?= $this->params['message'] ?>;
            if (message) {
                alert(message);
            }

            return;
        }

        const routeData = <?= $this->params['result'] ?>;

        routeData.forEach((route) => {
            if (route.type === 'route' && route.polyline) {
                addPolyline(route, map);
            } else if (route.type === "stop") {
                const pos = {
                    lat: route.start.lat,
                    lng: route.start.lng
                }
                addMarker(pos,map);
            }
        });
    }

    function addMarker(coords, map){
        const marker = new google.maps.Marker({
            map: map,
            draggable: false,
            position: coords,
        })
    }

    function addPolyline(route, map){
        const polyline = new google.maps.Polyline({
            path: google.maps.geometry.encoding.decodePath(route.polyline),
            map: map
        });

        const bounds = new google.maps.LatLngBounds();
        for (let i = 0; i < polyline.getPath().getLength(); i++) {
            bounds.extend(polyline.getPath().getAt(i));
        }
        map.fitBounds(bounds);
    }
</script>
<script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKCBIU_Pk1N5ZxXiSxE_u54PIB3ksPV1s&callback=initMap&libraries=&v=weekly&libraries=geometry">
</script>
</body>
</html>