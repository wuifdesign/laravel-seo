<?php
return array(

    'enable_logging' => false,

    'meta' =>  array(
        'title_styling' => '%title% - %subtitle%',

        'tags' => array(
            'title'       => 'PageName',
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