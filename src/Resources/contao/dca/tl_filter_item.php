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
    $GLOBALS['TL_DCA']['tl_filter_item']['palettes']['locationGoogle'] = '{type_legend},type,label;{field_config_legend},mandatory,placeholder;{expert_legend:hide},class,accesskey,tabindex;{template_legend:hide},customTpl;{invisible_legend:hide},invisible';
}
