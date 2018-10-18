<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dev',
            'username' => 'root',
            'password' => 'q123',
            'charset' => 'utf8',
            'on afterOpen' => function($event) { 
                $event->sender->createCommand("SET time_zone='+05:30';")->execute(); 
              },
        ],
    ],
];
