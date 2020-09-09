<?php

namespace frontend\models;

use Exception;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $mobile;
    public $email;
    public $body;
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['mobile', 'email', 'body'], 'required'],
            ['email', 'email', 'message' => 'Your email address should be correct form'],
            ['mobile', 'match', 'pattern' => '/^[0-9]+$/'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an inquire to the database using the information collected by the model.
     */
    public function sendInquire()
    {
        try {
            $uuid4 = Uuid::uuid4()->toString();

            Yii::$app->db->createCommand()->insert('inquire', [
                    'id' => $uuid4,
                    'email' => $this->email,
                    'mobile' => $this->mobile,
                    'content' => $this->body,
                    'created_time' => time(),
                ])->execute();

            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');

            Yii::$app->controller->refresh();
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            Yii::$app->controller->refresh();
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    /*
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }*/
}
