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
    // Add field
    $GLOBALS['TL_DCA']['tl_expose_module']['palettes']['googleMap'] = '{title_legend},name,headline,type;{google_maps_legend},googleInitialZoom,googleMinZoom,googleMaxZoom,googleType,googleGestureHandling,googleInteractive,googleControls,googleFullscreen,googleStreetview,googleMapTypeControl,iFrameFallbackIfAddressNotPublished;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

    // Add fields
    array_insert($GLOBALS['TL_DCA']['tl_expose_module']['fields'], -1, array(
        'googleInitialZoom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleInitialZoom'],
            'default'                 => 12,
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "int(2) unsigned NOT NULL default '12'",
        ),
        'googleMinZoom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleMinZoom'],
            'default'                 => 0,
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "int(2) unsigned NOT NULL default '10'",
        ),
        'googleMaxZoom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleMaxZoom'],
            'default'                 => 0,
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "int(2) unsigned NOT NULL default '14'",
        ),
        'googleType' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleType'],
            'default'                 => 'roadmap',
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array
            (
                'roadmap'   => 'roadmap',
                'satellite' => 'satellite',
                'hybrid'    => 'hybrid',
                'terrain'   => 'terrain',
            ),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'googleGestureHandling' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleGestureHandling'],
            'default'                 => 'cooperative',
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array
            (
                'cooperative'  => 'cooperative',
                'greedy'       => 'greedy',
                'auto'         => 'auto',
                'none'         => 'none'
            ),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(16) NOT NULL default ''"
        ),
        'googleInteractive' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleInteractive'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleControls' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleControls'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleFullscreen' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleFullscreen'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleStreetview' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleStreetview'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleMapTypeControl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleMapTypeControl'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'iFrameFallbackIfAddressNotPublished' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['iFrameFallbackIfAddressNotPublished'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        )
    ));
}
