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

            if(!filter.dom){
                console.warn('GooglePlacesFilter: Dom object could not be loaded by ID', filterId);
                return;
            }

            // check if the api ready for use
            if(filter.settings.initInstant && typeof google !== 'object'){
                console.warn('GooglePlacesFilter: google.maps is not defined. If you load the script by async, use onGoogleMapsApiReady-Callback and set option initInstant to false.');
                return;
            }

            // get hidden location fields
            filter.locationFields = {
                countryShort: filter.form.elements['country-short'],
                city: filter.form.elements['city'],
                postal: filter.form.elements['postal'],
                district: filter.form.elements['district'],
                latitude: filter.form.elements['latitude'],
                longitude: filter.form.elements['longitude']
            };

            filter.countryField = filter.form.elements['country'];
            filter.radiusField = filter.form.elements['radius-google'];

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
            //filter.dom.addEventListener('blur', onLocationValueBlur);
            filter.autocomplete.addListener('place_changed', onPlaceChanged);

            filter.countryOptions = [];

            // add country autocomplete
            if(filter.countryField){
                for (var i=0; i<filter.countryField.length; i++) {
                    if (filter.countryField[i].value !== "") {
                        filter.countryOptions.push(filter.countryField[i].value);
                    }
                }
                filter.countryField.addEventListener('change', onCountryChanged);
            }

            // set default country restriction
            filter.autocomplete.setComponentRestrictions({'country': filter.countryOptions});
        };

        var onLocationValueBlur = function () {
            if (filter.dom.value) {
            }
        };

        var onCountryChanged = function () {
            var country = filter.countryField.value;

            console.log(country);

            if (country === 'all' || country === '') {
                filter.autocomplete.setComponentRestrictions({'country': filter.countryOptions});
            } else {
                filter.dom.value = '';
                filter.dom.dispatchEvent(new Event('change'));
                clearLocationFields();

                filter.autocomplete.setComponentRestrictions({'country': [country]});
            }
        };

        var onPlaceChanged = function () {
            var place = filter.autocomplete.getPlace();
            var skipDistrict = false;

            if (place.types.includes('street_address') || place.types.includes('route') || place.types.includes('premise')) {
                filter.radiusField.selectedIndex = 5;
                filter.radiusField.options[0].style.display = 'none';
            } else {
                filter.radiusField.options[0].style.display = '';
                filter.radiusField.selectedIndex = 0;
                console.log(place);
            }
            filter.radiusField.dispatchEvent(new Event('change'));

            clearLocationFields();

            for (var i=0; i<place.address_components.length; i++) {
                if (place.address_components[i].types.includes('country')) {
                    filter.locationFields.countryShort.value = place.address_components[i].short_name;
                }
                if (place.address_components[i].types.includes('locality')) {
                    filter.locationFields.city.value = place.address_components[i].long_name;
                }
                if (place.address_components[i].types.includes('postal_code')) {
                    filter.locationFields.postal.value = place.address_components[i].short_name;
                }
                if (place.types.includes('sublocality') && place.address_components[i].types.includes('sublocality') && !skipDistrict) {
                    filter.locationFields.district.value = place.address_components[i].long_name;
                    if (place.address_components[i].types.includes('sublocality_level_2')) {
                        skipDistrict = true;
                    }
                }
            }

            filter.locationFields.latitude.value = place.geometry.location.lat();
            filter.locationFields.longitude.value = place.geometry.location.lng();
        };

        var clearLocationFields = function () {
            for (var field in filter.locationFields) {
                filter.locationFields[field].value = "";
            }
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
