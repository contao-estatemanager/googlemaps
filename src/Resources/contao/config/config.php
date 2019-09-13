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
    // Front end modules
    array_insert($GLOBALS['FE_MOD'], 0, array
    (
        'estatemanager' => array
        (
            'realEstateGoogleMap' => '\\ContaoEstateManager\\GoogleMaps\\ModuleRealEstateGoogleMap'
        )
    ));

    // Add expose module
    array_insert($GLOBALS['FE_EXPOSE_MOD']['media'], -1, array
    (
        'googleMap' => '\\ContaoEstateManager\\GoogleMaps\\ExposeModuleGoogleMap',
    ));

    // Add real estate filter items
    array_insert($GLOBALS['TL_RFI'], 2, array
    (
        'locationGoogle' => '\\ContaoEstateManager\\GoogleMaps\\FilterLocationGoogle',
        'radiusGoogle'   => '\\ContaoEstateManager\\GoogleMaps\\FilterRadiusGoogle',
    ));

    // HOOKS
    $GLOBALS['TL_HOOKS']['getTypeParameter'][]         = array('ContaoEstateManager\\GoogleMaps\\Filter', 'setLocationParameter');
    $GLOBALS['TL_HOOKS']['getParameterByGroups'][]     = array('ContaoEstateManager\\GoogleMaps\\Filter', 'setLocationParameter');
    $GLOBALS['TL_HOOKS']['getTypeParameterByGroups'][] = array('ContaoEstateManager\\GoogleMaps\\Filter', 'setLocationParameter');
    $GLOBALS['TL_HOOKS']['addRealEstateSorting'][]     = array('ContaoEstateManager\\GoogleMaps\\Filter', 'addRealEstateSorting');
}
