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
    // Add palettes
    $GLOBALS['TL_DCA']['tl_filter_item']['palettes']['locationGoogle'] = '{type_legend},type,label;{field_config_legend},mandatory,placeholder,googleAutocompleteType,googleDefaultRadius,googleForceRadius;{expert_legend:hide},class,accesskey,tabindex;{template_legend:hide},customTpl;{invisible_legend:hide},invisible';
    $GLOBALS['TL_DCA']['tl_filter_item']['palettes']['radiusGoogle']   = '{type_legend},type,label;{field_config_legend},mandatory,placeholder,googleRadiusOptions;{expert_legend:hide},class,accesskey,tabindex;{template_legend:hide},customTpl;{invisible_legend:hide},invisible';

    // Add fields
    $GLOBALS['TL_DCA']['tl_filter_item']['fields']['googleAutocompleteType'] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_filter_item']['googleAutocompleteType'],
        'exclude'                 => true,
        'inputType'               => 'select',
        'options'                 => array('geocode', 'regions'),
        'eval'                    => array('tl_class'=>'w50 clr'),
        'sql'                     => "varchar(32) NOT NULL default 'geocode'",
    );

    $GLOBALS['TL_DCA']['tl_filter_item']['fields']['googleDefaultRadius'] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_filter_item']['googleDefaultRadius'],
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => array('tl_class'=>'w50'),
        'sql'                     => "varchar(8) NOT NULL default '5'",
    );

    $GLOBALS['TL_DCA']['tl_filter_item']['fields']['googleForceRadius'] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_filter_item']['googleForceRadius'],
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => array('tl_class'=>'w50'),
        'sql'                     => "char(1) NOT NULL default ''",
    );

    $GLOBALS['TL_DCA']['tl_filter_item']['fields']['googleRadiusOptions'] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_filter_item']['googleRadiusOptions'],
        'default'                 => '1,2,3,4,5,10,15,20,30,50',
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => array('tl_class'=>'w50 clr'),
        'sql'                     => "varchar(64) NOT NULL default ''",
    );
}
