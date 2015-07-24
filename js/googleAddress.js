var map;
var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'long_name',
    country: 'long_name'
};

function initialize() {
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{ types: ['geocode'] });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        fillInAddress();
    });
}

function fillInAddress(_place) {
    $(".googleAddress").val("");
    var place = autocomplete.getPlace();
    $("#latitude").val(place.geometry.location.A);
    $("#longitude").val(place.geometry.location.F);
    loadAddressDetails(place);
}

function loadAddressDetails(place){
    var streetnumber = "";
    var streetname = "";
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if(addressType == "street_number"){
            streetnumber = place.address_components[i][componentForm[addressType]];
        }else if(addressType == "route"){
            streetname = place.address_components[i][componentForm[addressType]];
        }
        else if(addressType == "locality"){
            $("#city").val(place.address_components[i][componentForm[addressType]]);
        }
        else if(addressType == "administrative_area_level_1"){
            $("#state").val(place.address_components[i][componentForm[addressType]]);
        }
        else if(addressType == "country"){
            $("#country").val(place.address_components[i][componentForm[addressType]]);
        }
        if(streetnumber != "" && streetname !=""){
            $("#street").val(streetnumber + " , " + streetname);
        }
        else{
            $("#street").val(streetnumber + streetname);
        }
    }
}

function loadMap(lat,lng){


    var str = '[{ "lat" :"' + lat + '","lng" :"' + lng + '"}]';
    str = JSON.parse(str);

    jQuery('#map-canvas').gmap3({
        marker: {
            values: str,
            options: {
                icon:'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                draggable:true
            },
            events:{
                dragend: function(marker){
                    $(".googleAddress").val("");
                    $('#latitude').val(marker.getPosition().lat());
                    $('#longitude').val(marker.getPosition().lng());
                    $(this).gmap3({
                        getaddress:{
                            latLng:marker.getPosition(),
                            callback:function(results){
                                loadAddressDetails(results[0]);
                            }
                        }
                    });
                }
            }
        },
        map: {
            options: {
                zoom: 14,
                scrollwheel: true,
                streetViewControl: true
            }
        }
    });
}