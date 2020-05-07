<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/googlemaps
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

// ESTATEMANAGER
$GLOBALS['TL_ESTATEMANAGER_ADDONS'][] = array('ContaoEstateManager\\GoogleMaps', 'AddonManager');

if(ContaoEstateManager\GoogleMaps\AddonManager::valid()) {
    // Models
    $GLOBALS['TL_MODELS']['tl_geo_postal_code'] = '\\ContaoEstateManager\\GoogleMaps\\GeoPostalCodeModel';

    // Front end modules
    $GLOBALS['FE_MOD']['estatemanager']['realEstateGoogleMap'] = '\\ContaoEstateManager\\GoogleMaps\\ModuleRealEstateGoogleMap';

    // Add expose module
    $GLOBALS['FE_EXPOSE_MOD']['media']['googleMap'] = '\\ContaoEstateManager\\GoogleMaps\\ExposeModuleGoogleMap';

    // Add real estate filter items
    $GLOBALS['TL_RFI']['locationGoogle'] = '\\ContaoEstateManager\\GoogleMaps\\FilterLocationGoogle';
    $GLOBALS['TL_RFI']['radiusGoogle']   = '\\ContaoEstateManager\\GoogleMaps\\FilterRadiusGoogle';

    // Hooks
    $GLOBALS['TL_HOOKS']['getTypeParameter'][]         = array('ContaoEstateManager\\GoogleMaps\\Filter', 'setLocationParameter');
    $GLOBALS['TL_HOOKS']['getParameterByGroups'][]     = array('ContaoEstateManager\\GoogleMaps\\Filter', 'setLocationParameter');
    $GLOBALS['TL_HOOKS']['getTypeParameterByGroups'][] = array('ContaoEstateManager\\GoogleMaps\\Filter', 'setLocationParameter');
    $GLOBALS['TL_HOOKS']['addRealEstateSorting'][]     = array('ContaoEstateManager\\GoogleMaps\\Filter', 'addRealEstateSorting');
    $GLOBALS['TL_HOOKS']['prepareFilterData'][]        = array('ContaoEstateManager\\GoogleMaps\\Filter', 'resetLocationFilter');
    //$GLOBALS['TL_HOOKS']['beforeRealEstateImport'][]   = array('ContaoEstateManager\\GoogleMaps\\PostalCode', 'determinePostalCodeGeoData');
}
