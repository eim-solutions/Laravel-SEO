<?php

namespace LaravelSEO\Seo\Structs\Meta;

use LaravelSEO\Seo\Structs\Meta;

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
