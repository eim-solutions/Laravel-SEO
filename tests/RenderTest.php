<?php

namespace LaravelSEO\Seo\Test;

use Illuminate\Support\HtmlString;
use LaravelSEO\Seo\Builders\StructBuilder;
use LaravelSEO\Seo\Structs\Meta;
use LaravelSEO\Seo\Structs\Title;

class RenderTest extends TestCase
{
    public function testRenderAll()
    {
        seo()->title('My Title');

        $this->assertInstanceOf(HtmlString::class, seo()->render()->build());
    }

    public function testRenderSingleStruct()
    {
        $struct = Title::make()->body('My Title');

        $this->assertInstanceOf(HtmlString::class, StructBuilder::build($struct));
    }

    public function testAttributeRenderResult()
    {
        seo()->add(
            Title::make()->attr('attribute', 'value')
        );

        $this->assertEquals('<title attribute="value"></title>', seo()->render()->toHtml());
    }

    public function testSpacedAttributeRenderResult()
    {
        seo()->add(
            Title::make()->attr('attribute', 'value ')
        );

        $this->assertEquals('<title attribute="value"></title>', seo()->render()->toHtml());
    }

    public function testWrongSpacedAttributeRenderResult()
    {
        seo()->add(
            Title::make()->attr('   attribute ', 'value')
        );

        $this->assertEquals('<title attribute="value"></title>', seo()->render()->toHtml());
    }

    public function testBodyRenderResult()
    {
        seo()->add(
            Title::make()->body('My Body')
        );

        $this->assertEquals('<title>My Body</title>', seo()->render()->toHtml());
    }

    public function testSpacedBodyRenderResult()
    {
        seo()->add(
            Title::make()->body('My Body ')
        );

        $this->assertEquals('<title>My Body</title>', seo()->render()->toHtml());
    }

    public function testNullStringAttributeValue()
    {
        seo()->add(
            Meta::make()->attr('name', '0')
        );

        $this->assertEquals('<meta name="0" />', seo()->render()->toHtml());
    }

    public function testZeroIntegerAttributeValue()
    {
        seo()->add(
            Meta::make()->attr('name', 0)
        );

        $this->assertEquals('<meta name="0" />', seo()->render()->toHtml());
    }

    public function testEmptyStringAttributeValue()
    {
        seo()->add(
            Meta::make()->attr('name', '')
        );

        $this->assertEquals('<meta name />', seo()->render()->toHtml());
    }

    public function testEmptySpaceStringAttributeValue()
    {
        seo()->add(
            Meta::make()->attr('name', ' ')
        );

        $this->assertEquals('<meta name />', seo()->render()->toHtml());
    }

    public function testTrueBooleanAttributeValue()
    {
        seo()->add(
            Meta::make()->attr('name', true)
        );

        $this->assertEquals('<meta name="1" />', seo()->render()->toHtml());
    }

    public function testFalseBooleanAttributeValue()
    {
        seo()->add(
            Meta::make()->attr('name', false)
        );

        $this->assertEquals('<meta name="0" />', seo()->render()->toHtml());
    }

    public function testSeparator()
    {
        StructBuilder::$separator = '  ';

        seo()->add(
            Meta::make()->attr('name', 'first')
        );

        seo()->add(
            Meta::make()->attr('name', 'second')
        );

        $this->assertEquals('<meta name="first" />  <meta name="second" />', seo()->render()->toHtml());
    }

    public function testIndent()
    {
        StructBuilder::$separator = PHP_EOL;
        StructBuilder::$indent = '  ';

        seo()->add(
            Meta::make()->attr('name', 'first')
        );

        seo()->add(
            Meta::make()->attr('name', 'second')
        );

        $this->assertEquals('  <meta name="first" />' . PHP_EOL . '  <meta name="second" />', seo()->render()->toHtml());
    }

    public function testTagSyntaxHtml5()
    {
        config(['seo.tag_syntax' => StructBuilder::TAG_SYNTAX_HTML5]);

        seo()->add(
            Meta::make()->attr('name', true)
        );

        $this->assertEquals('<meta name="1">', seo()->render()->toHtml());
    }

    public function testTagSyntaxXhtml()
    {
        config(['seo.tag_syntax' => StructBuilder::TAG_SYNTAX_XHTML]);

        seo()->add(
            Meta::make()->attr('name', true)
        );

        $this->assertEquals('<meta name="1" />', seo()->render()->toHtml());
    }

    public function testTagSyntaxXhtmlStrict()
    {
        config(['seo.tag_syntax' => StructBuilder::TAG_SYNTAX_XHTML_STRICT]);

        seo()->add(
            Meta::make()->attr('name', true)
        );

        $this->assertEquals('<meta name="1"></meta>', seo()->render()->toHtml());
    }

    public function testTagSyntaxUnset()
    {
        config(['seo.tag_syntax' => null]);

        seo()->add(
            Meta::make()->attr('name', true)
        );

        $this->assertEquals('<meta name="1" />', seo()->render()->toHtml());
    }

    public function testTagSyntaxUnknown()
    {
        config(['seo.tag_syntax' => 'invalid']);

        seo()->add(
            Meta::make()->attr('name', true)
        );

        $this->assertEquals('<meta name="1" />', seo()->render()->toHtml());
    }
}
