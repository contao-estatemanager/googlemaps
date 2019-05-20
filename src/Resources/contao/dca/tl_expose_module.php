<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 */

if(Oveleon\ContaoImmoManagerGooglemapsBundle\AddonManager::valid()) {
    // Add field
    array_insert($GLOBALS['TL_DCA']['tl_expose_module']['palettes'], -1, array
    (
        'googleMap'  => '{title_legend},name,headline,type;{google_maps_legend},googleInitialZoom,googleMinZoom,googleMaxZoom,googleType,googleGestureHandling,googleInteractive,googleControls,googleFullscreen,googleStreetview,googleMapTypeControl;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID'
    ));

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
            'sql'                     => "int(2) unsigned NOT NULL default '0'",
        ),
        'googleMaxZoom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['googleMaxZoom'],
            'default'                 => 0,
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "int(2) unsigned NOT NULL default '24'",
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
        )
    ));
}

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 */
class tl_expose_module_immo_manager_googlemaps extends \Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }
}