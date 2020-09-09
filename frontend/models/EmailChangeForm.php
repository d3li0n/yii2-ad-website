<?php

namespace frontend\models;

use common\models\User;
use Yii;
use Exception;
use yii\base\Model;

/**
 * Class EmailChangeForm
 * @package frontend\models
 *
 * @author Dmytro Zhuravel
 */
class EmailChangeForm extends Model
{
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['password','email'],'required'],
            ['password','confirmPassword'],
            ['email', 'email', 'message' => 'Your email address should be correct form'],
        ];
    }

    /**
     * @param $attribute
     */
    public function confirmPassword($attribute)
    {
        $user = User::find()->where([
            'username' => Yii::$app->user->identity->username,
        ])->one();

        if (!Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
            $this->addError($attribute, 'Password is incorrect');
        }
    }

    public function updateEmail()
    {
        try {
            $user = User::find()->where([
                'id' => Yii::$app->user->getId(),
            ])->one();

            if($user->email === $this->email) {
                return Yii::$app->getSession()->setFlash('error','You email address is similar to old one.');
            }

            $user->email = $this->email;

            if ($user->save()) {
                Yii::$app->getSession()->setFlash(
                    'success',
                    'Email Changed.',
                );
            } else {
                Yii::$app->getSession()->setFlash(
                    'error', 'Email not changed.'
                );
            }
        }
        catch (Exception $e) {
            return Yii::$app->getSession()->setFlash(
                'error',"Something went wrong"
            );
        }
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Enter New Email',
            'password'=> 'Confirm with Password',
        ];
    }
}