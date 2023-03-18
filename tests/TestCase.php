<?php

namespace LaravelSEO\Seo\Test;

use Orchestra\Testbench\TestCase as BaseTestCase;
use PHPUnit\Framework\Constraint\RegularExpression;
use LaravelSEO\Seo\Builders\StructBuilder;
use LaravelSEO\Seo\Facades\Seo;
use LaravelSEO\Seo\Providers\SeoServiceProvider;

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
