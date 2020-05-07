<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/googlemaps
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */
if(ContaoEstateManager\GoogleMaps\AddonManager::valid()) {
    $GLOBALS['TL_DCA']['tl_geo_postal_code'] = array
    (
        // Config
        'config' => array
        (
            'dataContainer'               => 'Table',
            'sql' => array
            (
                'keys' => array
                (
                    'id' => 'primary'
                )
            )
        ),
        // Fields
        'fields' => array
        (
            'id' => array
            (
                'sql'                     => "int(10) unsigned NOT NULL auto_increment"
            ),
            'code' => array
            (
                'sql'                     => "varchar(8) NOT NULL default ''"
            ),
            'latitude' => array
            (
                'sql'                       => "varchar(32) NOT NULL default ''"
            ),
            'longitude' => array
            (
                'sql'                       => "varchar(32) NOT NULL default ''"
            )
        )
    );
}
