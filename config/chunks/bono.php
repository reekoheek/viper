<?php

// BONO
return array(
    // Using prettyURL
    'bono.prettifyURL' => false,

    // The providers
    'bono.providers' => array(
        '\\Norm\\Provider\\NormProvider',
        '\\KrisanAlfa\\Blade\\Provider\\BladeProvider',
        '\\Viper\\Provider\\AuthProvider',
        '\\Viper\\Provider\\ViperProvider',
    ),

    // The Middlewares
    'bono.middlewares' => array(
        '\\Bono\\Middleware\\ControllerMiddleware',
        '\\Bono\\Middleware\\ContentNegotiatorMiddleware',
        '\\Viper\\Middleware\\InstallerMiddleware',
        '\\Viper\\Middleware\\AuthMiddleware',
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
