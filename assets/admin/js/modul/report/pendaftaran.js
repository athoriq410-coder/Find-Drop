function embed_location(element, lat, long) {
    $('#frame_map').html('');
    $('#frame_map').html('<iframe src="https://maps.google.com/maps?q='+lat+','+long+'&hl=en;z=14&output=embed" style="height : 300px" class="w-100 rounded shadow-sm" allowfullscreen="" loading="lazy"></iframe>');
}