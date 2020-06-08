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

use Contao\BackendTemplate;
use Contao\Config;
use ContaoEstateManager\ExposeModule;
use ContaoEstateManager\Translator;
use Patchwork\Utf8;

/**
 * Expose module "google map".
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 */
class ExposeModuleGoogleMap extends ExposeModule
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'expose_mod_googlemap';

    /**
     * Do not display the module if there are no real etates
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . Utf8::strtoupper($GLOBALS['TL_LANG']['FMD']['virtual_tour'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=expose_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        $strBuffer = parent::generate();
        return $this->isEmpty ? '' : $strBuffer;
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        global $objPage;

        if(!!$this->iFrameFallbackIfAddressNotPublished && !$this->realEstate->objektadresseFreigeben)
        {
            if($apiKey = Config::get('googleMapsApiToken'))
            {
                $this->Template->src = "https://www.google.com/maps/embed/v1/search?q=" . $this->realEstate->plz . ($this->realEstate->land ? ',+' . $this->realEstate->land : '') . "&key=" . $apiKey;
            }
            else
            {
                $this->Template->src = "https://www.google.com/maps?hl=de&q=" . $this->realEstate->plz . ($this->realEstate->land ? ',+' . $this->realEstate->land : '') . "&ie=UTF8&z=11&output=embed";
            }

            $this->Template->useFallbackIframe = true;
            return;
        }

        $estateLat = $this->realEstate->breitengrad;
        $estateLng = $this->realEstate->laengengrad;

        if(!$estateLat || !$estateLng)
        {
            $this->isEmpty = true;
        }

        $markerImagePath = '';
        $markerSize = [0,0];

        // get marker image path
        if($arrMarker = GoogleMaps::getMarkerImage()){
            $markerImagePath = $arrMarker[0];
            $markerSize = $arrMarker;
        }

        // create map id
        $mapId = 'map' . $this->id . $objPage->id;

        // create map configuration
        $mapConfig = [
            'mapId'  => $mapId,
            'initInstant' => true,
            'map' => [
                'style'          => $this->googleStyle,
                'styles'         => GoogleMaps::getMapStyles(),
                'lat'            => $estateLat,
                'lng'            => $estateLng,
                'zoom'           => $this->googleInitialZoom,
                'minZoom'        => $this->googleMinZoom,
                'maxZoom'        => $this->googleMaxZoom,
                'gestureHandling'=> $this->googleGestureHandling,
                'controls'       => !!$this->googleControls,
                'mapTypeControl' => !!$this->googleMapTypeControl,
                'fullscreen'     => !!$this->googleFullscreen,
                'streetview'     => !!$this->googleStreetview,
                'interactive'    => !!$this->googleInteractive
            ]
        ];

        $this->Template->mapId = $mapId;
        $this->Template->lat = $estateLat;
        $this->Template->lng = $estateLng;
        $this->Template->config = json_encode($mapConfig);
        $this->Template->marker = json_encode([
            'imagePath'    => $markerImagePath,
            'imageWidth'   => $markerSize[0],
            'imageHeight'  => $markerSize[1]
        ]);

    }
}
