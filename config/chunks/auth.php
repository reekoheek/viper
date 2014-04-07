<?php

// Auth
return array(
    'auth' => array(
        // Unique identifier of Session Id, it use SHA1-SUM
        // You may change this section to avoid PHP section mess
        'id'    => '38c5f95720908407bc895d315cf7f7a06950576e',

        // Allowed URL
        'allow' => array(
            ''                    => null,
            '/'                   => null,
            '/about'              => null,
            '/install'            => null,
            '/entries/*'          => null,
            '/login'              => null,
            '/logout'             => null,
            '/tags.json'          => null,
            '/entries.json'       => null,
            '/author.json'        => null,
        ),

        // Need authentication
        'restricted' => array(
            '/entries'     => null,
            '/entries/*/*' => null,
        ),
    ),
);
