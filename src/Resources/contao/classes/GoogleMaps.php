<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 * @author    Daniele Sciannimanica <daniele@oveleon.de>
 */

namespace Oveleon\ContaoImmoManagerGooglemapsBundle;

use Oveleon\ContaoImmoManagerBundle\Translator;

class GoogleMaps
{
    /**
     * Return a style package for clustered markers
     *
     * @param $objFileModel
     * @param $disablePathCount
     *
     * @return array|boolean
     */
    public static function getMarkerImage($objFileModel=null, $disablePathCount=true)
    {
        if($objFileModel === null && $markerImage = \Config::get('googleMapsDefaultMarkerSRC'))
        {
            $objFileModel = \FilesModel::findByUuid($markerImage);
        }

        if ($objFileModel !== null && is_file(TL_ROOT . '/' . $objFileModel->path))
        {
            $markerSize = array();
            $markerImagePath = $objFileModel->path . ($disablePathCount ? '?disablePathCount=1' : '');

            $objFile = new \File($objFileModel->path);

            if($objFile !== null)
            {
                $imageSize = $objFile->imageSize;

                $markerSize[0] = $imageSize[0];
                $markerSize[1] = $imageSize[1];

                return [$markerImagePath, $markerSize];
            }
        }

        return false;
    }

    /**
     * Return a style package for clustered markers
     *
     * @param $arrClusterStyles
     *
     * @return array|boolean
     */
    public static function getClusterStyles($arrClusterStyles=null)
    {
        if($arrClusterStyles === null)
        {
            $arrClusterStyles = \StringUtil::deserialize( \Config::get('googleMapClusterStyles') );
        }

        if($arrClusterStyles)
        {
            $clusterStyles = [];
            $clusterSteps = [];

            foreach ($arrClusterStyles as $styles)
            {
                if($clusterImage = $styles['image']){
                    $objModel = \FilesModel::findByUuid($clusterImage);

                    if ($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path))
                    {
                        $url = $objModel->path . '?disablePathCount=1';

                        $objFile = new \File($objModel->path);

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

        return false;
    }
}