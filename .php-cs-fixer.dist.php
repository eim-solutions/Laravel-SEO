<?php

return LaravelSEO\Fixer\Config::make()
    ->in(__DIR__)
    ->preset(
        new LaravelSEO\Fixer\Presets\PrettyLaravel()
    )
    ->out();
