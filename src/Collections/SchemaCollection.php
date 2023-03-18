<?php

namespace laravel-seo\Seo\Collections;

use laravel-seo\Seo\Collections\Contracts\CollectionContract;
use laravel-seo\Seo\Schema\Schema as SchemaContainer;

class SchemaCollection implements CollectionContract
{
    /**
     * @var \laravel-seo\Seo\Schema\Schema[]
     */
    protected $schemas = [];

    /**
     * @return \laravel-seo\Seo\Schema\Schema[]
     */
    public function all(): array
    {
        return $this->schemas;
    }

    public function add(SchemaContainer $schema): void
    {
        $this->schemas[] = $schema;
    }

    /**
     * @param \laravel-seo\Seo\Schema\Schema[] $schemas
     */
    public function set(array $schemas): void
    {
        $this->schemas = $schemas;
    }
}
