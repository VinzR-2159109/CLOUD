document.addEventListener('DOMContentLoaded', function () {

    mapboxgl.accessToken = 'pk.eyJ1IjoidmluenJvb3NlbiIsImEiOiJjbHF5eWd3Nm4wbnh1Mmxua3Z4YnVibm80In0.1Lr8uIZ_cqvPs_CRYuqEnQ';

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [5.375158, 51.124705],
        zoom: 8
    });

    mapboxgl.accessToken = 'pk.eyJ1IjoidmluenJvb3NlbiIsImEiOiJjbHF5eWd3Nm4wbnh1Mmxua3Z4YnVibm80In0.1Lr8uIZ_cqvPs_CRYuqEnQ';
    const coordinatesGeocoder = function (query) {
        const matches = query.match(
            /^[ ]*(?:Lat: )?(-?\d+\.?\d*)[, ]+(?:Lng: )?(-?\d+\.?\d*)[ ]*$/i
        );
        if (!matches) {
            return null;
        }

        function coordinateFeature(lng, lat) {
            return {
                center: [lng, lat],
                geometry: {
                    type: 'Point',
                    coordinates: [lng, lat]
                },
                place_name: 'Lat: ' + lat + ' Lng: ' + lng,
                place_type: ['coordinate'],
                properties: {},
                type: 'Feature'
            };
        }

        const coord1 = Number(matches[1]);
        const coord2 = Number(matches[2]);
        const geocodes = [];

        if (coord1 < -90 || coord1 > 90) {
            geocodes.push(coordinateFeature(coord1, coord2));
        }

        if (coord2 < -90 || coord2 > 90) {
            geocodes.push(coordinateFeature(coord2, coord1));
        }

        if (geocodes.length === 0) {
            geocodes.push(coordinateFeature(coord1, coord2));
            geocodes.push(coordinateFeature(coord2, coord1));
        }

        return geocodes;
    };

    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        localGeocoder: coordinatesGeocoder,
        zoom: 4,
        placeholder: 'Try: Diepenbeek',
        mapboxgl: mapboxgl,
        reverseGeocode: true
    });

    geocoder.on('result', (event) => {
        const coordinates = event.result.geometry.coordinates;
        console.log('Clicked coordinates:', coordinates);

        document.getElementById('longitude').value = coordinates[0];
        document.getElementById('latitude').value = coordinates[1];
    });

    map.addControl(geocoder);
});