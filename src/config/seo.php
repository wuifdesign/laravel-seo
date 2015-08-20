<?php
return array(

    'enable_logging' => false,
    'used_prefixes'  => array('og'),

    'meta' =>  array(
        'title_styling' => '%title% - %subtitle%',
        'page_title'    => '123',

        'tags' => array(
            'title'       => null,
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
        'enabled' => true,

        'tags' => array(
            'title'       => '',
            'description' => '',
            'url'         => null,
            'type'        => null,
            'site_name'   => null,
            'images'      => array(),

            'latitude'       => null,
            'longitude'      => null,
            'street-address' => null,
            'locality'       => null,
            'region'         => null,
            'postal-code'    => null,
            'country-name'   => null,
        ),
    ),

    'twitter' =>  array(
        'enabled' => true,

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
            '_type'   => 'Organization',
            'name'    => null,
            'address' => array(
                '_type'           => 'PostalAddress',
                'streetAddress'   => null,
                'postalCode'      => null,
                'addressLocality' => null,
                'addressCountry' =>  null,
            ),
            'geo'  => array(
                '_type'     => 'GeoCoordinates',
                '_hidden'   => true,
                'latitude'  => null,
                'longitude' => null,
            ),
            'telephone' => null,
            'faxNumber' => null,
            'email'     => null,
        ),
    ),

);