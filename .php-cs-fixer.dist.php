<?php

return laravel-seo\Fixer\Config::make()
    ->in(__DIR__)
    ->preset(
        new laravel-seo\Fixer\Presets\PrettyLaravel()
    )
    ->out();
