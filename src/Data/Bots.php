<?php

namespace WhichBrowser\Data;

use WhichBrowser\Model\Browser;
use WhichBrowser\Model\Version;

class Bots
{
    public static $BOTS = [];
    public static $BOTS_REGEX = '';

    public static function identify($ua)
    {
        require_once __DIR__ . '/../../data/regexes/browsers-bots.php';

        if (preg_match(self::$BOTS_REGEX, $ua)) {
            require_once __DIR__ . '/../../data/browsers-bots.php';

            foreach (self::$BOTS as $i => $bot) {
                if (preg_match($bot['regexp'], $ua, $match)) {
                    return new Browser([
                        'name'      => $bot['name'],
                        'stock'     => false,
                        'version'   => isset($match[1]) && $match[1] ? new Version([ 'value' => $match[1], 'details' => isset($bot['details']) ? $bot['details'] : null ]) : null
                    ]);
                }
            }
        }

    }
}
