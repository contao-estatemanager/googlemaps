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

use Contao\Model;
use Contao\Model\Collection;

/**
 * Reads and writes geo postal codes
 *
 * @property integer $id
 * @property string  $code
 * @property string  $latitude
 * @property string  $longitude
 *
 * @method static GeoPostalCodeModel|null findById($id, array $opt=array())
 * @method static GeoPostalCodeModel|null findByPk($id, array $opt=array())
 * @method static GeoPostalCodeModel|null findOneBy($col, $val, array $opt=array())
 * @method static GeoPostalCodeModel|null findOneByCode($val, array $opt=array())
 * @method static GeoPostalCodeModel|null findOneByLatitude($val, array $opt=array())
 * @method static GeoPostalCodeModel|null findOneByLongitude($val, array $opt=array())
 *
 * @method static Collection|GeoPostalCodeModel[]|GeoPostalCodeModel|null findByCode($val, array $opt=array())
 * @method static Collection|GeoPostalCodeModel[]|GeoPostalCodeModel|null findByLatitude($val, array $opt=array())
 * @method static Collection|GeoPostalCodeModel[]|GeoPostalCodeModel|null findByLongitude($val, array $opt=array())
 * @method static Collection|GeoPostalCodeModel[]|GeoPostalCodeModel|null findMultipleByIds($val, array $opt=array())
 * @method static Collection|GeoPostalCodeModel[]|GeoPostalCodeModel|null findBy($col, $val, array $opt=array())
 * @method static Collection|GeoPostalCodeModel[]|GeoPostalCodeModel|null findAll(array $opt=array())
 *
 * @method static integer countById($id, array $opt=array())
 * @method static integer countByCode($val, array $opt=array())
 * @method static integer countByLatitude($val, array $opt=array())
 * @method static integer countByLongitude($val, array $opt=array())
 *
 * @author Fabian Ekert <https://github.com/eki89>
 */
class GeoPostalCodeModel extends Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_geo_postal_code';
}
