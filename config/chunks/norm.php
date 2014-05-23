<?php

use Norm\Schema\String;
use Viper\Schema\Password;
use Norm\Schema\Integer;
use Norm\Schema\Boolean;
use Norm\Schema\Text;
use Norm\Schema\Reference;

// NORM
return array(
    // The database
    'norm.databases' => array(
        'mongo' => array(
            'driver' => '\\Norm\\Connection\\MongoConnection',
            'database' => 'viper',
        ),
        // 'mysql' => array(
        //     'driver'   => '\\Norm\\Connection\\PDOConnection',
        //     'prefix'   => 'mysql',
        //     'database' => 'viper',
        //     'username' => '',
        //     'password' => '',
        // ),
        // 'sqlite' => array(
        //     'driver' => '\\Norm\\Connection\\PDOConnection',
        //     'prefix' => 'sqlite',
        //     'database' => __DIR__ . '/../../storage/viper.sqlite',
        // ),
    ),

    // Collections of database
    'norm.collections' => array(
        'default' => array(
            // Default observer
            'observers' => array(
                '\\Viper\\Observer\\Ownership' => array(),
                '\\Norm\\Observer\\Timestampable' => array(),
            ),
        ),
        'mapping' => array(
            'Author' => array(
                // Author using hashing for password, so we need an observer
                'observers' => array(
                    '\\Norm\\Observer\\Hashed' => array(
                        'fields'  => array('password'),
                        'algo'    => PASSWORD_BCRYPT,
                        // You may change the cost to improve hashing method
                        'options' => array('cost' => 12),
                    )
                ),
                'hidden' => array('password'),
                'schema' => array(
                    'username'   => String::getInstance('username')->filter('trim|required|unique:Author,username'),
                    'email'      => String::getInstance('email')->filter('trim|required|unique:Author,email'),
                    'first_name' => String::getInstance('first_name')->filter('trim'),
                    'last_name'  => String::getInstance('last_name')->filter('trim'),
                    'twitter'    => String::getInstance('twitter')->filter('trim'),
                    'password'   => Password::getInstance('password')->filter('trim|required|confirmed')
                        ->format('plain', function() { return '*hidden*'; }),
                ),
            ),
            'Tags' => array(
                'schema' => array(
                    'name' => String::getInstance('name')->filter('trim|required|unique:Tags,name'),
                )
            ),
            'Entries' => array(
                'schema' => array(
                    'title'   => String::getInstance('title')->filter('trim|required'),
                    'content' => String::getInstance('content')->filter('trim|required')
                        ->format('plain', function($value) {
                            return substr($value, 0, 50) . '...';
                        }),
                    'tags'    => Reference::getInstance('tags')->to('Tags', null, 'name'),
                )
            )
        ),
    ),
);
