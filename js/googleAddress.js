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

function fillInAddress() {
    $(".googleAddress").val("");
    var place = autocomplete.getPlace();
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