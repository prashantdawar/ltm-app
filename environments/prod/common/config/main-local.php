<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ltm',
            'username' => 'root',
            'password' => 'q123',
            'charset' => 'utf8',
            'on afterOpen' => function($event) { 
                $event->sender->createCommand("SET time_zone='+05:30';")->execute(); 
              },
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
