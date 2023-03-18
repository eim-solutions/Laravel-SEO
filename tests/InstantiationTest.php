<?php

namespace LaravelSEO\Seo\Test;

use LaravelSEO\Seo\Facades\Seo;
use LaravelSEO\Seo\Helpers\Hook;
use LaravelSEO\Seo\Services\SeoService;
use LaravelSEO\Seo\Structs\Meta;

class InstantiationTest extends TestCase
{
    public function testServiceInstance()
    {
        $this->assertInstanceOf(SeoService::class, app(SeoService::class));

        $this->assertInstanceOf(SeoService::class, Seo::make());

        $this->assertInstanceOf(SeoService::class, seo());
    }

    public function testHookInstance()
    {
        $this->assertInstanceOf(Hook::class, Hook::make());
    }

    public function testStructInstance()
    {
        $this->assertInstanceOf(Meta::class, Meta::make());
    }
}
