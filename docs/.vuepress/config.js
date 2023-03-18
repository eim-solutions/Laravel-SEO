module.exports = {
    base: '/Laravel-SEO/',
    title: 'Laravel SEO',
    description: 'SEO package made for maximum customization and flexibility ',
    host: 'localhost',
    port: 3001,
    themeConfig: {
        nav: [
            { text: 'Home', link: '/' },
            { text: 'GitHub', link: 'https://github.com/laravel-seo/Laravel-SEO' },
            { text: 'Packagist', link: 'https://packagist.org/packages/laravel-seo/laravel-seo' },
        ],
        sidebar: [
            '/',
            '/usage',
            '/structs',
            '/hooks',
            '/laravel-mix',
            '/schema-org',
            '/example-app',
        ],
        displayAllHeaders: true,
        sidebarDepth: 2
    }
};
