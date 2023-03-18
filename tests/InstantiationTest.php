<?php

namespace laravel-seo\Seo\Test;

use laravel-seo\Seo\Facades\Seo;
use laravel-seo\Seo\Helpers\Hook;
use laravel-seo\Seo\Services\SeoService;
use laravel-seo\Seo\Structs\Meta;

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
