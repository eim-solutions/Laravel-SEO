<?php

namespace laravel-seo\Seo\Structs\Meta;

use laravel-seo\Seo\Structs\Meta;
use laravel-seo\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#recommended-minimum
 */
class Viewport extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('name', 'viewport');
    }
}
