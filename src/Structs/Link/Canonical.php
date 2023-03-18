<?php

namespace laravel-seo\Seo\Structs\Link;

use laravel-seo\Seo\Structs\Link;
use laravel-seo\Seo\Structs\Struct;

class Canonical extends Link
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('rel', 'canonical');
    }
}
