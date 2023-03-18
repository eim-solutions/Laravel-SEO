<?php

namespace laravel-seo\Seo\Collections;

use laravel-seo\Seo\Collections\Contracts\CollectionContract;
use laravel-seo\Seo\Structs\Struct;

/**
 * The Seo class functions as an intermediate layer between the laravel dependency container
 * and the SeoService singleton instance.
 *
 * This intermediate class has been introduced to support the sections feature.
 */
class StructCollection implements CollectionContract
{
    /**
     * @var \laravel-seo\Seo\Structs\Struct[]
     */
    protected $structs = [];

    /**
     * @return \laravel-seo\Seo\Structs\Struct[]
     */
    public function all(): array
    {
        return $this->structs;
    }

    public function add(Struct $struct): void
    {
        $this->structs[] = $struct;
    }

    /**
     * @param \laravel-seo\Seo\Structs\Struct[] $structs
     */
    public function set(array $structs): void
    {
        $this->structs = $structs;
    }

    public function unset(int $index): void
    {
        unset($this->structs[$index]);
    }

    public function remove(Struct $struct): void
    {
        $this->structs = array_filter($this->structs, function (Struct $existing) use ($struct): bool {
            return $existing !== $struct;
        });
    }
}
