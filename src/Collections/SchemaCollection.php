<?php

namespace LaravelSEO\Seo\Collections;

use LaravelSEO\Seo\Collections\Contracts\CollectionContract;
use LaravelSEO\Seo\Schema\Schema as SchemaContainer;

class SchemaCollection implements CollectionContract
{
    /**
     * @var \LaravelSEO\Seo\Schema\Schema[]
     */
    protected $schemas = [];

    /**
     * @return \LaravelSEO\Seo\Schema\Schema[]
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
     * @param \LaravelSEO\Seo\Schema\Schema[] $schemas
     */
    public function set(array $schemas): void
    {
        $this->schemas = $schemas;
    }
}
