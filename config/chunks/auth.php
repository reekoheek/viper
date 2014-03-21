<?php

// Auth
return array(
    'auth' => array(
        // Unique identifier of Session Id
        'id'    => '38c5f95720908407bc895d315cf7f7a06950576e',

        // Allowed URL
        'allow' => array(
            ''                    => NULL,
            '/'                   => NULL,
            '/about'              => NULL,
            '/install'            => NULL,
            '/entries/*'          => NULL,
            '/login'              => NULL,
            '/logout'             => NULL,
            '/tags.json'          => NULL,
            '/entries.json'       => NULL,
            '/author.json'        => NULL,
        ),

        // Need authentication
        'restricted' => array(
            '/entries'     => NULL,
            '/entries/*/*' => NULL,
        ),
    ),
);
