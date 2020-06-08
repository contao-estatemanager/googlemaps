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
use Contao\File;
use Contao\FilesModel;
use Contao\StringUtil;
use ContaoEstateManager\Translator;

class GoogleMaps
{
    /**
     * Return a style package for clustered markers
     *
     * @param $objFileModel
     * @param $disablePathCount
     *
     * @return array|null
     *
     * @throws \Exception
     */
    public static function getMarkerImage($objFileModel=null, $disablePathCount=true): ?array
    {
        if($objFileModel === null && $markerImage = Config::get('googleMapsDefaultMarkerSRC'))
        {
            $objFileModel = FilesModel::findByUuid($markerImage);
        }

        if ($objFileModel !== null && is_file(TL_ROOT . '/' . $objFileModel->path))
        {
            $markerSize = array();
            $markerImagePath = $objFileModel->path . ($disablePathCount ? '?disablePathCount=1' : '');

            $objFile = new File($objFileModel->path);

            if($objFile !== null)
            {
                $imageSize = $objFile->imageSize;

                $markerSize[0] = $imageSize[0];
                $markerSize[1] = $imageSize[1];

                return [$markerImagePath, $markerSize];
            }
        }

        return null;
    }
    /**
     * Return a style package for map
     *
     * @return array|null
     */
    public static function getMapStyles(): ?array
    {
        if(!Config::get('googleMapUseMapStyles'))
        {
            return null;
        }

        return json_decode( Config::get('googleMapStylesScript') ) ?: null;
    }

    /**
     * Return a style package for clustered markers
     *
     * @param $arrClusterStyles
     *
     * @return array|null
     *
     * @throws \Exception
     */
    public static function getClusterStyles($arrClusterStyles=null): ?array
    {
        if(!Config::get('googleMapUseClusterStyles'))
        {
           return null;
        }

        if($arrClusterStyles === null)
        {
            $arrClusterStyles = StringUtil::deserialize(Config::get('googleMapClusterStyles'));
        }

        if($arrClusterStyles)
        {
            $clusterStyles = [];
            $clusterSteps = [];

            foreach ($arrClusterStyles as $styles)
            {
                if($clusterImage = $styles['image']){
                    $objModel = FilesModel::findByUuid($clusterImage);

                    if ($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path))
                    {
                        $url = $objModel->path . '?disablePathCount=1';

                        $objFile = new File($objModel->path);

                        if($objFile !== null)
                        {
                            $imageSize = $objFile->imageSize;

                            $width  = $imageSize[0];
                            $height = $imageSize[1];

                            $clusterSteps[]  = intval($styles['step']);

                            $clusterStyles[] = array(
                                'url'       => $url,
                                'width'     => $width,
                                'height'    => $height,
                                'anchor'    => [
                                    intval($styles['textOffsetY']),
                                    intval($styles['textOffsetX'])
                                ],
                                'textColor' => '#' . $styles['textColor'],
                                'textSize'  => $styles['textSize']
                            );
                        }
                    }
                }
            }

            return [$clusterSteps, $clusterStyles];
        }

        return null;
    }
}
