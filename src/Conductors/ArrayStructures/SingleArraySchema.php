<?php

namespace LaravelSEO\Seo\Conductors\ArrayStructures;

class SingleArraySchema extends AbstractArraySchema
{
    /**
     * @param string $value
     */
    public function apply($value): void
    {
        if ( ! is_string($value)) {
            throw new \InvalidArgumentException('Invalid argument supplied for single array schema');
        }

        $this->call([
            $value,
        ]);
    }
}
