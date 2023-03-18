<?php

namespace laravel-seo\Seo\Test\Structs;

use laravel-seo\Seo\Structs\Struct;

class UniqueMultiAttributeStruct extends Struct
{
    protected $unique = true;

    protected $uniqueAttributes = ['first', 'second'];

    protected function tag(): string
    {
        return 'unique-multi-attr';
    }
}
