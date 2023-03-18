<?php

namespace LaravelSEO\Seo\Test\Structs;

use LaravelSEO\Seo\Structs\Struct;

class UniqueSingleAttributeStruct extends Struct
{
    protected $unique = true;

    protected $uniqueAttributes = ['first'];

    protected function tag(): string
    {
        return 'unique-single-attr';
    }
}
