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
                $event->sender->createCommand("SET time_zone='Asia/Calcutta")->execute(); 
              },
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
