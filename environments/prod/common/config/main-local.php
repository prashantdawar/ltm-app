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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.mailtrap.io',
                'username'   => '62e9ee46743f47',
                'password'   => '9241a8a1eaebea', // your password
                'port'       => '2525',
            //    'encryption' => 'tls',
            ],           
        ],
    ],
];
