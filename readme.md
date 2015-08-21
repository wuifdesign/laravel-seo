## Laravel SEO

- **Laravel**: 5.1

This package includes a helper for SEO Meta tags (Meta, OpenGraph, Twitter) and rendering schema blocks.

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
        'used_prefixes'  => array('og'),

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

        'schema' =>  array(
            'organization' => array(
                'type'   => 'Organization',
                'tags' => array(
                    'name'    => null,
                    'address' => array(
                        'type'           => 'PostalAddress',
                        'tags' => array(
                            'streetAddress'   => null,
                            'postalCode'      => null,
                            'addressLocality' => null,
                            'addressCountry' =>  null,
                        ),
                    ),
                    'geo'  => array(
                        'type'     => 'GeoCoordinates',
                        'hidden'   => true,
                        'tags' => array(
                            'latitude'  => null,
                            'longitude' => null,
                        ),
                    ),
                    'telephone' => null,
                    'faxNumber' => null,
                    'email'     => null,
                ),

            ),
        ),

    );

You can now add strings for the tags, and if you want to set the attribute for the element, you can parse an array:

    'name' => array($value, $attribute)

## Usage ##

### Meta ###

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

    SEOTool::metatags()->addProperty($key, $value[, $name]);
    SEOTool::opengraph()->addProperty($key, $value[, $name]);
    SEOTool::twitter()->addProperty($key, $value[, $name]);

To render all prefixes defined in the config use (available prefixes: 'og', 'fb', 'music', 'video', 'article', 'book', 'website')

    <html prefix="{{ SEOTool::renderPrefixes() }}">

### Schema ###

You can define as many schemas as you like in the config file. To display the schema just add the following code.

    {!! SEOTool::renderSchema($key) !!}
