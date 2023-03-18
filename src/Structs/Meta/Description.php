<?php

namespace LaravelSEO\Seo\Structs\Meta;

use LaravelSEO\Seo\Structs\Meta;
use LaravelSEO\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#recommended-minimum
 */
class Description extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('name', 'description');
    }
}
