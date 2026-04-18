$(document).ready(function() {
    // GMAP
    $('input#search_map').keypress(function(e) {
        if (e.keyCode == '13') {
            e.preventDefault();
        }
    });
    if (navigator.geolocation) {
        $('#map').html('');
        navigator.geolocation.getCurrentPosition(
            (position) => {
                let lat = $('#lat').val();
                let lng = $('#long').val();
                const longLat = {
                    lat: lat ? parseFloat(lat) : position.coords.latitude,
                    lng: lng ? parseFloat(lng) : position.coords.longitude,
                };
                $('#long').val(longLat.lng);
                $('#lat').val(longLat.lat);
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: longLat,
                    zoom: 17,
                    mapTypeId: 'roadmap',
                });

                // init default position
                let marker = new google.maps.Marker({
                    position: longLat,
                    draggable: true,
                    // icon: `${baseUrl}assets/media/markers/office_icon.png`,
                });
                marker.setMap(map);

                google.maps.event.addListener(marker, 'dragend', function(m) {
                    $('#long').val(m.latLng.lng());
                    $('#lat').val(m.latLng.lat());
                });

                // Create the search box and link it to the UI element.
                const input = document.getElementById('search_map');
                input.classList.remove('d-none');
                const searchBox = new google.maps.places.SearchBox(input, {
                    keyword: 'establishment'
                });
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', () => {
                    searchBox.setBounds(map.getBounds());
                });

                searchBox.addListener('places_changed', () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // For each place, get the icon, name and location.
                    const bounds = new google.maps.LatLngBounds();

                    places.forEach((place) => {
                        if (!place.geometry || !place.geometry.location) {
                            return;
                        }

                        // set position
                        $('#long').val(place.geometry.location.lng());
                        $('#lat').val(place.geometry.location.lat());
                        marker.setPosition(place.geometry.location);
                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            },
            () => {
                let mapPermission = $('#map_permission').html();
                $('#map').html(mapPermission);
            }
        );
    }
});