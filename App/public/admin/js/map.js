$(document).ready(function (){
    setTimeout(() => {
        if(document.getElementById("location_map"))
        {
            $lat = $('.form #latitude').val();
            $long = $('.form #longitude').val();
    
            var latlng = new google.maps.LatLng($lat, $long);
            var mapOptions = {
            zoom: 10,
            center: latlng
            }
    
            location_map = new google.maps.Map(document.getElementById('location_map'), mapOptions);
    
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng($lat, $long),
                map: location_map,
                draggable: true
            });
    
            google.maps.event.addListener(marker, 'dragend', function(evt){
                $('.form #latitude').val(evt.latLng.lat());
                $('.form #longitude').val(evt.latLng.lng());
            });
        }
    }, 3000);
});