<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 */

array_insert($GLOBALS['TL_DCA']['tl_real_estate_config']['fields'], 1, array
(
    'googleMapsApiToken' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_real_estate_config']['googleMapsApiToken'],
        'inputType'               => 'text',
        'eval'                    => array('tl_class'=>'w50')
    ),
    'googleMapsDefaultMarkerSRC' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_real_estate_config']['googleMapsDefaultMarkerSRC'],
        'exclude'                 => true,
        'inputType'               => 'fileTree',
        'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'isGallery'=>true, 'extensions'=>Config::get('validImageTypes'), 'tl_class'=>'clr w50'),
    ),
    'googleMapClusterStyles' => array
    (
        'label'     => &$GLOBALS['TL_LANG']['tl_real_estate_config']['googleMapClusterStyles'],
        'exclude'   => true,
        'inputType' => 'multiColumnWizard',
        'eval'      => [
            'maxCount'  => 5,
            'tl_class'  => 'clr',
            'columnFields' => [
                'image' => [
                    'label'         => &$GLOBALS['TL_LANG']['tl_real_estate_config']['clusterImage'],
                    'exclude'       => true,
                    'inputType'     => 'fileTree',
                    'eval'          => array('mandatory'=>true, 'fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>Config::get('validImageTypes')),
                ],
                'textColor' => [
                    'label'         => &$GLOBALS['TL_LANG']['tl_real_estate_config']['clusterTextColor'],
                    'inputType'     => 'text',
                    'eval'          => array('mandatory'=>true, 'valign'=>'bottom', 'maxlength'=>6, 'size'=>1, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'wizard', 'style'=>'width:100px'),
                ],
                'textSize' => [
                    'label'         => &$GLOBALS['TL_LANG']['tl_real_estate_config']['clusterTextSize'],
                    'inputType'     => 'text',
                    'default'       => 14,
                    'eval'          => array('mandatory'=>true, 'valign'=>'bottom', 'style'=>'width:100px', 'rgxp'=>'natural')
                ],
                'textOffsetX' => [
                    'label'         => &$GLOBALS['TL_LANG']['tl_real_estate_config']['clusterTextOffsetX'],
                    'inputType'     => 'text',
                    'default'       => 0,
                    'eval'          => array('mandatory'=>true, 'valign'=>'bottom', 'style'=>'width:100px', 'rgxp'=>'digit')
                ],
                'textOffsetY' => [
                    'label'         => &$GLOBALS['TL_LANG']['tl_real_estate_config']['clusterTextOffsetY'],
                    'inputType'     => 'text',
                    'default'       => 0,
                    'eval'          => array('mandatory'=>true, 'valign'=>'bottom', 'style'=>'width:100px', 'rgxp'=>'digit')
                ],
                'step' => [
                    'label'         => &$GLOBALS['TL_LANG']['tl_real_estate_config']['clusterStep'],
                    'inputType'     => 'text',
                    'default'       => 0,
                    'eval'          => array('mandatory'=>true, 'valign'=>'bottom', 'style'=>'width:80px', 'rgxp'=>'natural')
                ]
            ],
        ]
    )
));

// Extend the default palettes
Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('google_maps_legend', 'template_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField(array('googleMapsApiToken', 'googleMapsDefaultMarkerSRC', 'googleMapsDefaultClusterSRC', 'googleMapClusterStyles'), 'google_maps_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_real_estate_config')
;