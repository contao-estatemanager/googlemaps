<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/reference
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

namespace ContaoEstateManager\GoogleMaps;

use Contao\Controller;

class PostalCode extends Controller
{

    /**
     * Determine postal code
     *
     * @param $objRealEstate
     * @param $context
     */
    public function determinePostalCodeGeoData(&$objRealEstate, $context): void
    {
        if (empty($objRealEstate->plz))
        {
            return;
        }

        $objGeoPostalCode = GeoPostalCodeModel::findOneByCode($objRealEstate->plz);

        if ($objGeoPostalCode === null)
        {

        }

        $objRealEstate->breitengrad = $objGeoPostalCode->latitude;
        $objRealEstate->laengengrad = $objGeoPostalCode->longitude;
    }
}
