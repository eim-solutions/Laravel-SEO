<?php

namespace LaravelSEO\Seo\Test\Structs;

use LaravelSEO\Seo\Structs\Struct;

class UniqueMultiAttributeStruct extends Struct
{
    protected $unique = true;

    protected $uniqueAttributes = ['first', 'second'];

    protected function tag(): string
    {
        return 'unique-multi-attr';
    }
}
