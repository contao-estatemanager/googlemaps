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
use ContaoEstateManager\ModuleRealEstate;
use Patchwork\Utf8;

/**
 * Front end module "real estate google map".
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 */
class ModuleRealEstateGoogleMap extends ModuleRealEstate
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_realEstateGoogleMap';

    /**
     * Generate wildcard for backend
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . Utf8::strtoupper($GLOBALS['TL_LANG']['FMD']['realEstateGoogleMap'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        /** @var \PageModel $objPage */
        global $objPage;

        $markerImagePath = '';
        $markerSize = [0,0];

        // get marker image path
        if($arrMarker = GoogleMaps::getMarkerImage()){
            $markerImagePath = $arrMarker[0];
            $markerSize = [
                $arrMarker[1][0],
                $arrMarker[1][1]
            ];
        }

        // get cluster styles
        $clustering = !!$this->googleUseCluster;
        $clusterSteps = null;
        $clusterStyles = null;

        if($clustering && $arrStyles = GoogleMaps::getClusterStyles())
        {
            $clusterSteps = $arrStyles[0];
            $clusterStyles = $arrStyles[1];
        }
        else
        {
            $clustering = false;
        }

        // create map id
        $mapId = 'map' . $this->id;

        // create map configuration
        $mapConfig = [
            'initInstant' => true,
            'source' => [
                'path'         => '/api/estatemanager/v1/estates',
                'param'        => [
                    'dataType'     => 'geojson',
                    'filter'       => true,
                    'filterMode'   => $this->filterMode,
                    'groups'       => $this->realEstateGroups,
                    'pageId'       => $objPage->id,
                    'moduleId'     => $this->id
                ]
            ],
            'popup' => [
                'source' => [
                    'path'    => '/api/estatemanager/v1/estates/%id%',
                    'param'   => [
                        'template' => $this->googleMapPopupTemplate ?: '',
                        'moduleId' => $this->id
                    ]
                ]
            ],
            'spider' => [
                'spiderfier'   => !!$this->googleUseSpiderfier,
                'options'      => [
                    'keepSpiderfied'  => true,
                    'markersWontMove' => true,
                    'markersWontHide' => true
                ]
            ],
            'cluster' => [
                'clustering'   => $clustering,
                'clusterSteps' => $clusterSteps,
                'styles'       => $clusterStyles,
                'options'      => [
                    'maxZoom' => !!$this->googleUseSpiderfier ? $this->googleMaxZoom - 1 : $this->googleMaxZoom,
                ]
            ],
            'marker' => [
                'icon' => [
                    'imagePath'    => $markerImagePath,
                    'imageWidth'   => $markerSize[0],
                    'imageHeight'  => $markerSize[1]
                ]
            ],
            'map' => [
                'style'          => $this->googleStyle,
                'styles'         => GoogleMaps::getMapStyles(),
                'lat'            => $this->googleInitialLat,
                'lng'            => $this->googleInitialLng,
                'zoom'           => $this->googleInitialZoom,
                'minZoom'        => $this->googleMinZoom,
                'maxZoom'        => $this->googleMaxZoom,
                'gestureHandling'=> $this->googleGestureHandling,
                'controls'       => !!$this->googleControls,
                'mapTypeControl' => !!$this->googleMapTypeControl,
                'fullscreen'     => !!$this->googleFullscreen,
                'streetview'     => !!$this->googleStreetview,
                'interactive'    => !!$this->googleInteractive,
                'bounds'         => !!$this->googleUseBounce,
            ]
        ];

        // HOOK: Modify parameters for module estates
        if (isset($GLOBALS['TL_HOOKS']['compileRealEstateGoogleMap']) && \is_array($GLOBALS['TL_HOOKS']['compileRealEstateGoogleMap']))
        {
            foreach ($GLOBALS['TL_HOOKS']['compileRealEstateGoogleMap'] as $callback)
            {
                $this->import($callback[0]);
                $this->{$callback[0]}->{$callback[1]}($this->Template, $mapConfig, $this);
            }
        }

        $this->Template->mapId = $mapId;
        $this->Template->config = json_encode($mapConfig);
    }
}
