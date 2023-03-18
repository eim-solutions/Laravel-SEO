<?php

namespace laravel-seo\Seo\Test;

use Orchestra\Testbench\TestCase as BaseTestCase;
use PHPUnit\Framework\Constraint\RegularExpression;
use laravel-seo\Seo\Builders\StructBuilder;
use laravel-seo\Seo\Facades\Seo;
use laravel-seo\Seo\Providers\SeoServiceProvider;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        StructBuilder::$separator = PHP_EOL;
        StructBuilder::$indent = null;
    }

    protected function getPackageProviders($app)
    {
        return [
            SeoServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Seo' => Seo::class,
        ];
    }

    public static function assertMatchesRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        static::assertThat($string, new RegularExpression($pattern), $message);
    }
}
