<?php

namespace LaravelSEO\Seo\Structs\Meta;

use LaravelSEO\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#facebook-open-graph
 */
class OpenGraph extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['property'];

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function property($value = null, bool $escape = true)
    {
        $this->addAttribute('property', "og:{$value}", $escape);

        return $this;
    }
}
