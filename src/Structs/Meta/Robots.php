<?php

namespace LaravelSEO\Seo\Structs\Meta;

use LaravelSEO\Seo\Structs\Meta;
use LaravelSEO\Seo\Structs\Struct;

class Robots extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('name', 'robots');
    }
}
