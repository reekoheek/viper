<?php

// BONO
return array(
    // Using prettyURL
    'bono.prettifyURL' => false,

    // The providers
    'bono.providers' => array(
        '\\Viper\\Provider\\ViperProvider',
        '\\Viper\\Provider\\AuthProvider',
        '\\KrisanAlfa\\Blade\\Provider\\BladeProvider',
        '\\Norm\\Provider\\NormProvider',
    ),

    // The Middlewares
    'bono.middlewares' => array(
        '\\Viper\\Middleware\\AuthMiddleware',
        '\\Bono\\Middleware\\ContentNegotiatorMiddleware',
        '\\Bono\\Middleware\\ControllerMiddleware',
        '\\Viper\\Middleware\\InstallerMiddleware',
    ),

    // Content Negotiatior
    'bono.contentNegotiator' => array(
        'extensions' => array(
            'json' => 'application/json',
        ),
        'views' => array(
            'application/json' => '\\Bono\\View\\JsonView',
        ),
    ),

    // Application Controller
    'bono.controllers' => array(
        'default' => '\\Norm\\Controller\\NormController',
        'mapping' => array(
            '/author'  => '\\Viper\\Controller\\AuthorController',
            '/tags'    => NULL,
            '/entries' => NULL,
        ),
    ),

    // Blade Template Engine
    'bono.blade' => array(
        'templates' => array('../templates'),
        'cache'     => '../cache',
        'layout'    => 'layout',
    ),

    // Bono Themeing
    'bono.theme' => array(
        'class' => '\\KrisanAlfa\\Blade\\Theme\\BladeTheme',
    ),

    // Bono Partial (segment of template)
    'bono.partial.view' => '\\KrisanAlfa\\Blade\\BonoBlade',
);
