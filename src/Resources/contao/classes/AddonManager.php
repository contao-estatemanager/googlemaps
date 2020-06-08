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
use Contao\Environment;
use ContaoEstateManager\EstateManager;

class AddonManager
{
    /**
     * Addon name
     * @var string
     */
    public static $name = 'GoogleMaps';

    /**
     * Addon config key
     * @var string
     */
    public static $key  = 'addon_google_maps_license';

    /**
     * Is initialized
     * @var boolean
     */
    public static $initialized  = false;

    /**
     * Is valid
     * @var boolean
     */
    public static $valid  = false;

    /**
     * Licenses
     * @var array
     */
    private static $licenses = [
        '5e943d759468eaa0039e6cea784ed995',
        'e303a16b14126e94834c71e6eb5ee7ca',
        '65c5cba620a3e29ab49dbece46474a20',
        '561cc2c893e665c5deaea693cc922c13',
        'a7b1bc10e926b9571b9e15b1e92b7caa',
        '5981ae5a773dc6d9eea300b6f277d50c',
        '4a20f0d28feb796865f3af0c44e550ad',
        'a537663e06c9cf414f046715039f8a0c',
        'eafdd6a922c074b45d94874015024614',
        '7c6cff22b0cb58248b8bb846eec54455',
        '10e0b6e1bba1137cc578e6018490eea4',
        '0630768cb99dce7c5d9bf7013fe29041',
        'ecbf2885b5c9d5246d333a347ad76517',
        '94808b65ece6e58ccf427f0e600bb7df',
        'bec6b7074de7c24de2d7b25706b20122',
        'de979d9ac3568e71d46cab8f1b49f3f1',
        'bf01b3103d62ff1350a1ab5c7fe04e59',
        'aea3428f5aa2b4f90c0c1560c61438fe',
        '21811471463a6a08efece8b30cae2746',
        '8b1a27d72159c9ea09f38857b79bc90b',
        '77e3396cbb413b26396123dd37363947',
        '0bc369a163d17cd163ff7d70cc94e20d',
        '3cdad6af3939bbd5d590b4ee27fe3589',
        '525b9430075d365f91cdfefd683705cc',
        '8198c12411e17af208796c7995152ad7',
        '82e49a134db10408d01e65d69197bc29',
        'e0b725bf6b76343de5b6c07fabd6f7b8',
        'e5d37e8603e3a5b0577f1ffc9a4c9fee',
        '0809f28e690835d0c4d3e95bf59498a2',
        'ecfbbeef7c08a4cc9ced0ad835b40db0',
        '48ef12b2366bf2172e2a5a1c4635c1ac',
        '9be17972d132bdeabc115756ad733944',
        'c2ecaedc6e4f29a606f08b31aa27144e',
        'd1f8dd0258d0e29b9786bd46290790db',
        '001486f67a8b0f828b315f7c9b8fdefd',
        '9ae0695bf86d1309d4fd7f1b778c22a7',
        '699cf631a9216870422c27b000d29870',
        'c0ff0ac0a414ceee00668025878d3240',
        'eb14849d82377ee581855d3bb67a510b',
        'cac1bac1cc3d7e0c3342a5e42660db95',
        '70cdd2cce4767834a9b00aace8848112',
        '33bd23f6e7c6bacb29a914f5b058d110',
        '5211e0fc5d35ef4e6f460426ae795179',
        '449104c5c4c4f50947008997fb06ab06',
        'd98875937bd05c736d8f13b53b836809',
        'a5b942b7e347721eb5fb59fa4fa2b499',
        'd24ca4a606f5810997e399d93dc930d5',
        '20637485adf444cde1edd4cdaa12cb73',
        '4a7d4ee0ed01f5ecd16b47aeaf4ad470',
        'aceb5d0c7587ac848c7edae79cfd4813'
    ];

    public static function getLicenses()
    {
        return static::$licenses;
    }

    public static function valid()
    {
        if(strpos(Environment::get('requestUri'), '/contao/install') !== false)
        {
            return true;
        }

        if (static::$initialized === false)
        {
            static::$valid = EstateManager::checkLicenses(Config::get(static::$key), static::$licenses, static::$key);
            static::$initialized = true;
        }

        return static::$valid;
    }

}
