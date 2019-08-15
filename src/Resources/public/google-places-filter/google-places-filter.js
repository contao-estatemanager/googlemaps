/**
 * Google Places Filter
 *
 * @author Fabian Ekert <fabian@oveleon.de>
 * @version 0.0.1
 */
var GooglePlacesFilter = (function () {

    'use strict';

    var Constructor = function (filterId, settings) {
        var pub = {};
        var filter = {};

        var defaults = {
            initInstant: false,
        };

        /**
         * Initialize Google Places Filter
         */
        var init = function () {
            // extend default settings
            filter.settings = extend(true, defaults, settings);

            // get dom object
            filter.dom = document.getElementById(filterId);

            // get form object
            filter.form = filter.dom.form;

            // get hidden location fields
            filter.fields = {
                countryShort: filter.form.getElementsByClassName('country-short')[0],
                city: filter.form.getElementsByClassName('city')[0],
                postal: filter.form.getElementsByClassName('postal')[0],
                district: filter.form.getElementsByClassName('district')[0],
                latitude: filter.form.getElementsByClassName('latitude')[0],
                longitude: filter.form.getElementsByClassName('longitude')[0],
            };

            if(!filter.dom){
                console.warn('GooglePlacesFilter: Dom object could not be loaded by ID', filterId);
                return;
            }

            // check if the api ready for use
            if(filter.settings.initInstant && typeof google !== 'object'){
                console.warn('GooglePlacesFilter: google.maps is not defined. If you load the script by async, use onGoogleMapsApiReady-Callback and set option initInstant to false.');
                return;
            }

            // init on api ready callback
            if(!filter.settings.initInstant){
                document.addEventListener('googlemaps.onApiReady', createFilter);

            // init filter directly
            }else{
                createFilter();
            }
        };

        var createFilter  = function(){
            // create filter
            filter.autocomplete = new google.maps.places.Autocomplete(filter.dom, {
                types: ['geocode']
            });

            filter.autocomplete.setFields(['address_component', 'type', 'geometry']);

            // add listener
            filter.autocomplete.addListener('place_changed', onPlaceChanged);

            filter.countryOptions = [];

            // add country autocomplete
            if(!!filter.form.elements['country']){
                filter.countryField = filter.form.elements['country'];
                for (var i=0; i<filter.countryField.length; i++) {
                    if (filter.countryField[i].value !== "") {
                        filter.countryOptions.push(filter.countryField[i].value);
                    }
                }
                filter.countryField.addEventListener('change', setAutocompleteCountry);
            }

            // set default country restriction
            filter.autocomplete.setComponentRestrictions({'country': filter.countryOptions});
        };

        var setAutocompleteCountry = function(){
            var country = filter.countryField.value;

            if (country === 'all' || country === '') {
                filter.autocomplete.setComponentRestrictions({'country': filter.countryOptions});
            } else {
                filter.autocomplete.setComponentRestrictions({'country': country});
            }
        };

        var onPlaceChanged = function () {
            var place = filter.autocomplete.getPlace();
            var skipDistrict = false;

            console.log(place);



            filter.fields.countryShort.value = "";
            filter.fields.city.value = "";
            filter.fields.postal.value = "";
            filter.fields.district.value = "";
            filter.fields.latitude.value = "";
            filter.fields.longitude.value = "";

            for (var i=0; i<place.address_components.length; i++) {
                if (place.address_components[i].types.includes('country')) {
                    filter.fields.countryShort.value = place.address_components[i].short_name;
                }
                if (place.address_components[i].types.includes('locality')) {
                    filter.fields.city.value = place.address_components[i].long_name;
                }
                if (place.address_components[i].types.includes('postal_code')) {
                    filter.fields.postal.value = place.address_components[i].short_name;
                }
                if (place.types.includes('sublocality') && place.address_components[i].types.includes('sublocality') && !skipDistrict) {
                    filter.fields.district.value = place.address_components[i].long_name;
                    if (place.address_components[i].types.includes('sublocality_level_2')) {
                        skipDistrict = true;
                    }
                }
            }

            filter.fields.latitude.value = place.geometry.location.lat();
            filter.fields.longitude.value = place.geometry.location.lng();
        };

        /**
         * Helper methods
         */
        var extend = function () {
            // Variables
            var extended = {};
            var deep = false;
            var i = 0;
            var length = arguments.length;

            // Check if a deep merge
            if ( Object.prototype.toString.call( arguments[0] ) === '[object Boolean]' ) {
                deep = arguments[0];
                i++;
            }

            // Merge the object into the extended object
            var merge = function (obj) {
                for ( var prop in obj ) {
                    if ( Object.prototype.hasOwnProperty.call( obj, prop ) ) {
                        // If deep merge and property is an object, merge properties
                        if ( deep && Object.prototype.toString.call(obj[prop]) === '[object Object]' ) {
                            extended[prop] = extend( true, extended[prop], obj[prop] );
                        } else {
                            extended[prop] = obj[prop];
                        }
                    }
                }
            };

            // Loop through each object and conduct a merge
            for ( ; i < length; i++ ) {
                var obj = arguments[i];
                merge(obj);
            }

            return extended;
        };

        init();

        return pub;
    };

    return Constructor;
})();
