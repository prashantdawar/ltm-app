<?php

namespace frontend\models;

use Yii;

/**
 * This is model class for Email.
 * 
 * 
 * 
 * 
 * @property $to;
 * @property $subject;
 * @property $view;
 * @property $model_group;
 * 
 */
class Email {
    public $to = [];
    // public $from = '';
    // public $bcc = [];
    

    public $subject = '';
    public $view = '';   // view for email. Necessarily email template.
    public $model_group = []; //key value pair like 'view render'.

    public function __construct($address, $subject, $view, $model_group){
        $this->to = !(empty($address['to'])) ? $address['to']:[];
        // $this->from = !(empty($address['from'])) ? $address['from']:'';
        // $this->bcc = !(empty($address['bcc'])) ? $address['bcc']:[];
        $this->subject = !(empty($subject)) ? $subject:'';
        $this->view = !(empty($view)) ? $view:'';
        $this->model_group = !(empty($model_group)) ? $model_group:[]; 
    }

    public function send()
    {   
        $userModel = \frontend\models\PrimaryIds::find()->select('email')->asArray()->one();
        // try {

        $mailer =  Yii::$app
            ->mailer
            ->compose(['html' => $this->view], $this->model_group)
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->to)
            ->setBcc(['sales@datapacks.in', $userModel['email']])
            ->setSubject($this->subject)
            ->send();
        // } catch (Exception $exception){
        //     var_dump($exception); die;
        // }

        return $mailer;
    }
}