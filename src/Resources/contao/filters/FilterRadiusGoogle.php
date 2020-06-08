<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/googlemaps
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

namespace ContaoEstateManager\GoogleMaps;

use Contao\Config;
use ContaoEstateManager\FilterModel;
use ContaoEstateManager\FilterWidget;

/**
 * Class FilterRadiusGoogle
 *
 * @author Fabian Ekert <fabian@oveleon.de>
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class FilterRadiusGoogle extends FilterWidget
{
    /**
     * Submit user input
     *
     * @var boolean
     */
    protected $blnSubmitInput = true;

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'filter_radius_google';

    /**
     * The CSS class prefix
     *
     * @var string
     */
    protected $strPrefix = 'widget widget-radius-google';

    /**
     * Initialize the object
     *
     * @param array       $arrAttributes Attributes array
     * @param FilterModel $objFilter     Parent filter model
     */
    public function __construct($arrAttributes, $objFilter=null)
    {
        parent::__construct($arrAttributes, $objFilter);
    }

    /**
     * Add specific attributes
     *
     * @param string $strKey   The attribute key
     * @param mixed  $varValue The attribute value
     */
    public function __set($strKey, $varValue)
    {
        switch ($strKey)
        {
            case 'name':
                $this->strName = 'radius-google';
                break;

            case 'mandatory':
                if ($varValue)
                {
                    $this->arrAttributes['required'] = 'required';
                }
                else
                {
                    unset($this->arrAttributes['required']);
                }
                parent::__set($strKey, $varValue);
                break;

            default:
                parent::__set($strKey, $varValue);
                break;
        }
    }

    /**
     * Parse the template file and return it as string
     *
     * @param array $arrAttributes An optional attributes array
     *
     * @return string The template markup
     */
    public function parse($arrAttributes=null): string
    {
        $strClass = 'select';

        // Custom class
        if ($this->strClass != '')
        {
            $strClass .= ' ' . $this->strClass;
        }

        $this->strClass = $strClass;

        $strOptions = $this->googleRadiusOptions ? $this->googleRadiusOptions : Config::get('googleRadiusOptions');
        $options = array_map('trim', explode(',', $strOptions));

        $arrOptions = array();

        $arrOptions[] = array
        (
            'value'    => '',
            'selected' => '',
            'label'    => $this->placeholder
        );

        foreach ($options as $value)
        {
            $arrOptions[] = array
            (
                'value'    => $value,
                'selected' => $value === $_SESSION['FILTER_DATA']['radius-google'] ? ' selected' : '',
                'label'    => $value.' km'
            );
        }

        $this->options = $arrOptions;

        return parent::parse($arrAttributes);
    }

    /**
     * Rudimentary generate method
     */
    public function generate() {}
}
