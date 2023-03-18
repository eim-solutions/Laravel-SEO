<?php

use laravel-seo\Seo\Services\SeoService;

if ( ! function_exists('seo')) {
    /**
     * Create SeoService instance.
     *
     * @param string|null $section
     *
     * @return \laravel-seo\Seo\Services\SeoService
     */
    function seo(string $section = null): SeoService
    {
        if (null === $section) {
            return app(SeoService::class);
        }

        return app(SeoService::class)->section($section);
    }
}
