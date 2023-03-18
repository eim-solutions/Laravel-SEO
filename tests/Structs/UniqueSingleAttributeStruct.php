<?php

namespace laravel-seo\Seo\Test\Structs;

use laravel-seo\Seo\Structs\Struct;

class UniqueSingleAttributeStruct extends Struct
{
    protected $unique = true;

    protected $uniqueAttributes = ['first'];

    protected function tag(): string
    {
        return 'unique-single-attr';
    }
}
