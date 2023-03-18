<?php

namespace laravel-seo\Seo\Structs\Meta;

use laravel-seo\Seo\Structs\Meta;
use laravel-seo\Seo\Structs\Struct;

class Robots extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('name', 'robots');
    }
}
