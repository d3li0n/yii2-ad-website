<?php

namespace frontend\models;
use Exception;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Class PasswordChangeForm
 * @package frontend\models
 *
 * @author Dmytro Zhuravel
 */
class PasswordChangeForm extends Model
{
    public $oldPass;
    public $newPass;
    public $repeatNewPass;

    public function rules()
    {
        return [
            [['oldPass','newPass','repeatNewPass'],'required'],
            ['oldPass','confirmPassword'],
            ['newPass', 'match', 'pattern' => '/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,25}$/', 'message' => 'Your password should contain at least one number and one special character and it should be minimum 8'],
            ['repeatNewPass', 'match', 'pattern' => '/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,25}$/', 'message' => 'Your password should contain at least one number and one special character and it should be minimum 8'],
            ['repeatNewPass','compare','compareAttribute'=>'newPass'],
        ];
    }

    public function confirmPassword($attribute)
    {
        try {
            $user = User::find()->where([
                'username' => Yii::$app->user->identity->username,
            ])->one();

            if (!Yii::$app->security->validatePassword($this->oldPass, $user->password_hash)) {
                $this->addError($attribute, 'Old password is incorrect');
            }
        } catch (Exception $e) {
            Yii::$app->getSession()->setFlash(
                'error','Something went wrong.'
            );
        }
    }

    public function updatePassword()
    {
        try {
            $user = Yii::$app->user->identity->username;
            $user = User::find()->where([
                'username' => $user,
            ])->one();

            $user->password_hash = Yii::$app->security->generatePasswordHash($_POST['PasswordChangeForm']['newPass']);

            if ($user->save()) {
                return Yii::$app->getSession()->setFlash(
                    'success','Password changed'
                );
            } else {
                return Yii::$app->getSession()->setFlash(
                    'error','Password not changed'
                );
            }
        }
        catch(Exception $e)
        {
            return Yii::$app->getSession()->setFlash(
                'error',"Something went wrong"
            );
        }
    }

    public function attributeLabels()
    {
        return [
            'oldPass'=>'Old Password',
            'newPass'=>'New Password',
            'repeatNewPass'=>'Repeat New Password',
        ];
    }
}