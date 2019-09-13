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
    array_insert($GLOBALS['TL_DCA']['tl_module']['palettes'], 0, array
    (
        'realEstateGoogleMap'      => '{title_legend},name,headline,type;{config_legend},realEstateGroups,filterMode;{google_maps_legend},googleInitialLat,googleInitialLng,googleInitialZoom,googleMinZoom,googleMaxZoom,googleType,googleGestureHandling,googleUseBounce,googleUseCluster,googleUseSpiderfier,googleUseBounds,googleInteractive,googleControls,googleFullscreen,googleStreetview,googleMapTypeControl;{redirect_legend},jumpTo;{template_legend:hide},customTpl,googleMapPopupTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID',
    ));

    // Add estate manager fields
    array_insert($GLOBALS['TL_DCA']['tl_module']['fields'], 1, array
    (
        'googleInitialLat' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleInitialLat'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'googleInitialLng' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleInitialLng'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'googleInitialZoom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleInitialZoom'],
            'default'                 => 12,
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "int(2) unsigned NOT NULL default '12'",
        ),
        'googleMinZoom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleMinZoom'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "int(2) unsigned NOT NULL default '1'",
        ),
        'googleMaxZoom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleMaxZoom'],
            'default'                 => 20,
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "int(2) unsigned NOT NULL default '20'",
        ),
        'googleType' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleType'],
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
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleGestureHandling'],
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
        'googleUseCluster' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleUseCluster'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'googleUseSpiderfier' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleUseSpiderfier'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'googleUseBounce' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleUseBounce'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'googleInteractive' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleInteractive'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleControls' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleControls'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleFullscreen' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleFullscreen'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleStreetview' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleStreetview'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleMapTypeControl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleMapTypeControl'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'googleMapPopupTemplate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleMapPopupTemplate'],
            'default'                 => 'real_estate_default',
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_module_estatemanager_google_map', 'getGoogleMapPopupTemplates'),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'googleFilterAddSorting' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleFilterAddSorting'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'googleFilterLat' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleFilterLat'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'googleFilterLng' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['googleFilterLng'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
    ));

    $GLOBALS['TL_DCA']['tl_module']['fields']['defaultSorting']['options'][] = 'location';

    // Extend sorting subpalette
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(array('googleFilterAddSorting', 'googleFilterLat', 'googleFilterLng'), 'sorting_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->applyToSubpalette('addSorting', 'tl_module')
    ;
}

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 * @author Fabian Ekert <fabian@oveleon.de>
 */
class tl_module_estatemanager_google_map extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Return all real estate list templates as array
     *
     * @return array
     */
    public function getGoogleMapPopupTemplates()
    {
        return $this->getTemplateGroup('maps_google_popup_');
    }
}
