# Hooks

Hooks allow the modification of a Structs **body** or **attributes**.

### Adding hooks to Structs

```php
use LaravelSEO\Seo\Helpers\Hook;

$hook = Hook::make()
    ->onBody()
    ->callback(function ($body) {
        return $body;
    });
```

**Method 1**: Call the `SeoService::hook()` method to apply a given `$hook` to a Struct class.

```php
use LaravelSEO\Seo\Structs\Title;

seo()->hook(Title::class, $hook);
```

**Method 2**: Apply the `$hook` directly to the Struct.

```php
use LaravelSEO\Seo\Structs\Title;

Title::hook($hook);
```

Both methods are basically the same, choose which one you prefer.

## Examples

For example, you want to append a site name to the body of every `<title>` tag:

#### Modify the `body` of all `Title` Structs.

```php
use LaravelSEO\Seo\Helpers\Hook;
use LaravelSEO\Seo\Structs\Title;

Title::hook(
    Hook::make()
        ->onBody()
        ->callback(function ($body) {
            return ($body ? $body . ' | ' : '') . 'Site-Name';
        })
);
```

```php
use LaravelSEO\Seo\Structs\Title;

seo()->add(Title::make()->body('Home'));  // <title>Home | Site-Name</title>
seo()->add(Title::make()->body(null));    // <title>Site-Name</title>
```

----

#### Modify any attribute of the `OpenGraph` Struct which has the attribute `property` with value `og:site_name`

```php
use LaravelSEO\Seo\Helpers\Hook;
use LaravelSEO\Seo\Structs\Meta\OpenGraph;

OpenGraph::hook(
    Hook::make()
        ->whereAttribute('property', 'og:site_name')
        ->onAttributes()
        ->callback(function ($attributes) {

            $attributes['new'] = 'This will be added to all meta tags with property="og:site_name"';

            return $attributes;
        })
);
```

----

#### Modify the `content` attribute of the `OpenGraph` Struct which has the attribute `property` with value `og:title`

```php
use LaravelSEO\Seo\Helpers\Hook;
use LaravelSEO\Seo\Structs\Meta\OpenGraph;

OpenGraph::hook(
    Hook::make()
        ->whereAttribute('property', 'og:title')
        ->onAttribute('content')
        ->callback(function ($content) {
            return ($content ? $content . ' | ' : '') . 'Site-Name';
        })
);
```

```php
use LaravelSEO\Seo\Structs\Meta\OpenGraph;

$seo->add(OpenGraph::make()->property('title')->content('Home'));  // <meta ... content="Home | Site-Name" />
$seo->add(OpenGraph::make()->property('title')->content(null));    // <meta ... content="Site-Name" />
```

## Reference

### Hook Instance

```php
use LaravelSEO\Seo\Helpers\Hook;

$hook = Hook::make();

$hook = new Hook;
```

### Hook Targets

#### Target Struct Body

You will receive `$body` parameter of type `null|string` in the callback function

```php

$hook
    ->onBody()
    ->callback(function ($body) {
        return $body;
    });
```

#### Target any Struct Attribute

You will receive `$attributes` parameter of type `array` in the callback function

```php
$hook
    ->onAttributes('content')
    ->callback(function ($attributes) {
        return $attributes;
    });
```

#### Target a specific Struct Attribute

You will receive `$attribute` parameter of type `null|string` in the callback function

```php
$hook
    ->onAttribute('content')
    ->callback(function ($attribute) {
        return $attribute;
    });
```

### Hook Filters

Filter Structs by `$attribute` with value `$value`

```php
$hook->whereAttribute($attribute, $value);
```
