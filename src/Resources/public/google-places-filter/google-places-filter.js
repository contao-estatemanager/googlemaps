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

            });

            // add listener
            filter.autocomplete.addEventListener('place_changed', onPlaceChanged);
        };

        function onPlaceChanged() {
            var place = filter.autocomplete.getPlace();
            if (place.geometry) {
                console.log(place.geometry);
            } else {
                filter.dom.placeholder = 'Enter a city';
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
