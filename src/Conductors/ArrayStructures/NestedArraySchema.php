<?php

namespace LaravelSEO\Seo\Conductors\ArrayStructures;

class NestedArraySchema extends AbstractArraySchema
{
    /**
     * @param array<string, mixed> $data
     */
    public function apply($data): void
    {
        if ( ! is_array($data)) {
            throw new \InvalidArgumentException('Invalid argument supplied for nested array schema');
        }

        foreach ($data as $attribute => $value) {
            $this->call([$attribute, $value]);
        }
    }
}
