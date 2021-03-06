<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Calcutta',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'enableSwiftMailerLogging' => true,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.saugatcomputer.com',
                'username'   => 'support@saugatcomputer.com',
                'password'   => 'Qwertydp#123', // your password
                'port'       => '25',
            //    'encryption' => 'tls',
            ],
            // 'transport' => [
            //     'class'      => 'Swift_SmtpTransport',
            //     'host'       => 'smtp.mailtrap.io',
            //     'username'   => '62e9ee46743f47',
            //     'password'   => '9241a8a1eaebea', // your password
            //     'port'       => '25',
            // //    'encryption' => 'tls',
            // ]           
        ]
    ],
];
