<?php

namespace LaravelSEO\Seo\Structs\Link;

use LaravelSEO\Seo\Structs\Link;
use LaravelSEO\Seo\Structs\Struct;

class Canonical extends Link
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('rel', 'canonical');
    }
}
