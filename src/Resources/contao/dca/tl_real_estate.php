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
    // Add fields
    $GLOBALS['TL_DCA']['tl_real_estate']['fields']['plzBreitengrad'] = array
    (
        'label'                     => &$GLOBALS['TL_LANG']['tl_real_estate']['plzBreitengrad'],
        'exclude'                   => true,
        'inputType'                 => 'text',
        'eval'                      => array('maxlength'=>32, 'tl_class'=>'w50'),
        'sql'                       => "varchar(32) NOT NULL default ''",
    );

    $GLOBALS['TL_DCA']['tl_real_estate']['fields']['plzLaengengrad'] = array
    (
        'label'                     => &$GLOBALS['TL_LANG']['tl_real_estate']['plzLaengengrad'],
        'exclude'                   => true,
        'inputType'                 => 'text',
        'eval'                      => array('maxlength'=>32, 'tl_class'=>'w50'),
        'sql'                       => "varchar(32) NOT NULL default ''",
    );

    // Extend default palette
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(array('plzBreitengrad', 'plzLaengengrad'), 'laengengrad', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
        ->applyToPalette('default', 'tl_real_estate')
    ;
}
