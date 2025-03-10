<?php

namespace LaravelSEO\Seo\Test;

use LaravelSEO\Seo\Structs\Meta\Charset;
use LaravelSEO\Seo\Structs\Meta\Robots;
use LaravelSEO\Seo\Structs\Meta\Viewport;
use LaravelSEO\Seo\Structs\Title;
use LaravelSEO\Seo\Test\Structs\UniqueMultiAttributeStruct;
use LaravelSEO\Seo\Test\Structs\UniqueSingleAttributeStruct;

class CollisionTest extends TestCase
{
    public function testShouldNotCollide()
    {
        seo()->add(
            Charset::make()
        );

        seo()->add(
            Viewport::make()->content('width=device-width, initial-scale=1')
        );

        $contents = seo()->render()->toArray();

        $this->assertCount(2, $contents);
    }

    public function testNormalElementCollisions()
    {
        seo()->add(
            Title::make()->body('My Title')
        );

        seo()->add(
            Title::make()->body('My Second Title')
        );

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertEquals('<title>My Second Title</title>', $contents[0]);
    }

    public function testRobotsElementCollisions()
    {
        seo()->add(
            Robots::make()->content('index')
        );

        seo()->add(
            Robots::make()->content('noindex')
        );

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertEquals('<meta name="robots" content="noindex" />', $contents[0]);
    }

    public function testVoidElementSingleAttributeCollisions()
    {
        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('content', 'My Site Name')
        );

        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('content', 'My Second Site Name')
        );

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertMatchesRegularExpression('/content\=\"My Second Site Name\"/', $contents[0]);
    }

    public function testVoidElementSingleOptionalAttributeCollisions()
    {
        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('content', 'My Site Name')
        );

        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('second', 'unique')
                ->attr('content', 'My Second Site Name')
        );

        $contents = seo()->render()->toArray();

        $this->assertCount(2, $contents);

        $this->assertMatchesRegularExpression('/content\=\"My Site Name\"/', $contents[0]);
        $this->assertMatchesRegularExpression('/content\=\"My Second Site Name\"/', $contents[1]);
    }

    public function testVoidElementMultipleAttributesCollisions()
    {
        seo()->add(
            UniqueMultiAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('second', 'also unique')
                ->attr('content', 'My Value')
        );

        seo()->add(
            UniqueMultiAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('second', 'also unique')
                ->attr('content', 'My Second Value')
        );

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertMatchesRegularExpression('/content\=\"My Second Value\"/', $contents[0]);
    }
}
