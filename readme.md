## Laravel SEO (WIP!)

- **Laravel**: 5.1

This package includes a helper for SEO Meta tags (Meta, OpenGraph, Twitter).

## Installation ##

Firstly you want to include this package in your `composer.json` file,

    "require": {
        "wuifdesign/laravel-seo": "0.1.*"
    }

and update or install via composer:

    composer update

Or you can just run:

    composer require wuifdesign/laravel-seo

Next you open up `app/config/app.php` and add

    providers' => [
         WuifDesign\SEO\ServiceProvider::class
    ]

If you want to use the facade you should also add the following to the file

    'aliases' => [
        'SEOTool'=> \WuifDesign\SEO\Facades\SEOTool::class,
    ],

Now you should run

    php artisan vendor:publish

to copy the config file to `app/config/seo.php`.

After running the command, the config file will look like the following:

    return array(

        'enable_logging' => false,

        'meta' =>  array(
            'title_styling' => '%title% - %subtitle%',
            'page_title'       => '123',

            'tags' => array(
                'title' => null,
                'description' => null,
                'author'      => array(null, 'rel'),
            ),

            'webmaster_tags' => array(
                'google'    => null,
                'bing'      => null,
                'alexa'     => null,
                'pinterest' => null,
                'yandex'    => null,
            ),
        ),

        'opengraph' =>  array(
            'tags' => array(
                'title'       => '',
                'description' => '',
                'url'         => null,
                'type'        => null,
                'site_name'   => null,
                'images'      => array(),
            ),
        ),

        'twitter' =>  array(
            'tags' => array(
                'card'        => null,
                'title'       => null,
                'description' => null,
                'site'        => null,
                'creator'     => null,
                'url'         => null,
                'images'      => array(),
            ),
        ),

    );

You can now add strings for the tags, and if you want to set the attribute for the element, you can parse an array:

    'name' => array($value, $attribute)

## Usage ##

Add Title/description using:

    SEOTool::setTitle('Title');
    SEOTool::setDescription('Description');
    SEOTool::addImage('http://example.com/hello-world.jpg');

If you want to render all SEO Tags using Blade just add the following to your `<head>` section.

    {!! SEOTool::render() !!}

If you just want to add a metadata to a single meta type you can also use

    SEOTool::metatags()->setTitle('Title');
    SEOTool::opengraph()->setTitle('Title');
    SEOTool::twitter()->setTitle('Title');

Or if you just want to add a custom tag use

    SEOTool::metatags()->addProperty(addProperty($key, $value[, $name]);