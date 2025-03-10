<?php

namespace LaravelSEO\Seo\Conductors;

use LaravelSEO\Seo\Conductors\ArrayStructures\AbstractArraySchema;
use LaravelSEO\Seo\Conductors\ArrayStructures\AttributeArraySchema;
use LaravelSEO\Seo\Conductors\ArrayStructures\NestedArraySchema;
use LaravelSEO\Seo\Conductors\ArrayStructures\SingleArraySchema;
use LaravelSEO\Seo\Services\SeoService;
use LaravelSEO\Seo\Structs;

class ArrayFormatConductor
{
    /**
     * @var \LaravelSEO\Seo\Services\SeoService
     */
    private $seo;

    public function __construct(SeoService $seo)
    {
        $this->seo = $seo;
    }

    /**
     * Get the predefined schemas for array formatting.
     *
     * @return array<string, \LaravelSEO\Seo\Conductors\ArrayStructures\AbstractArraySchema>
     */
    private function getSchemas(): array
    {
        return [
            /*
             * Single key-value pair.
             *
             *     $data = [
             *         'title' => 'Foo'
             *     ];
             */

            'title' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->title($value);
            }),

            'description' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->description($value);
            }),

            'charset' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->charset($value);
            }),

            'viewport' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->viewport($value);
            }),

            'canonical' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->canonical($value);
            }),

            'image' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->image($value);
            }),

            /*
             * Nested item with key-value pairs.
             *
             *     $data = [
             *         'twitter' => [
             *             'card' => 'summary',
             *             'creator' => '@LaravelSEO'
             *         ]
             *     ];
             */

            'twitter' => NestedArraySchema::make()->callback(function (string $attribute, string $value) {
                $this->seo->twitter($attribute, $value);
            }),

            'og' => NestedArraySchema::make()->callback(function (string $attribute, string $value) {
                $this->seo->og($attribute, $value);
            }),

            /*
             * Item with attribute schema.
             *
             *     $data = [
             *         'meta' => [
             *             [
             *                 'name' => 'copyright',
             *                 'content' => 'Roman Zipp'
             *             ],
             *             [
             *                 'name' => 'theme-color',
             *                 'content' => 'red'
             *             ]
             *         ]
             *     ];
             */

            'meta' => AttributeArraySchema::make(Structs\Meta::class)->callback(function (Structs\Meta $struct, array $attributes) {
                $this->seo->add(
                    $struct->attrs($attributes)
                );
            }),

            'link' => AttributeArraySchema::make(Structs\Link::class)->callback(function (Structs\Link $struct, array $attributes) {
                $this->seo->add(
                    $struct->attrs($attributes)
                );
            }),
        ];
    }

    /**
     * Get a array schema based on index.
     *
     * @param string $index
     *
     * @return \LaravelSEO\Seo\Conductors\ArrayStructures\AbstractArraySchema|null
     */
    private function getSchema(string $index): ?AbstractArraySchema
    {
        return $this->getSchemas()[$index] ?? null;
    }

    /**
     * Set the array data and pass it to the seo service.
     *
     * @param array<string, mixed> $data
     */
    public function setData(array $data): void
    {
        foreach ($data as $key => $value) {
            $schema = $this->getSchema($key);

            if (null === $schema) {
                throw new \InvalidArgumentException("Unknown key {$key} provided for seo array format");
            }

            $schema->apply($value);
        }
    }
}
