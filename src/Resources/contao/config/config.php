<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 */

// Front end modules
array_insert($GLOBALS['FE_MOD'], 0, array
(
    'immomanager' => array
    (
        'realEstateGoogleMap'     => '\\Oveleon\\ContaoImmoManagerGooglemapsBundle\\ModuleRealEstateGoogleMap'
    )
));

// Add expose module
array_insert($GLOBALS['FE_EXPOSE_MOD']['media'], -1, array
(
    'googleMap' => '\\Oveleon\\ContaoImmoManagerGooglemapsBundle\\ExposeModuleGoogleMap',
));