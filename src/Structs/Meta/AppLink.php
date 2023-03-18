<?php

namespace laravel-seo\Seo\Structs\Meta;

use laravel-seo\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#app-links
 */
class AppLink extends Meta
{
    /**
     * @param mixed $value
     * @param bool $escape
     *
     * @return $this
     */
    public function property($value, bool $escape = true)
    {
        $this->addAttribute('property', "al:{$value}", $escape);

        return $this;
    }
}
