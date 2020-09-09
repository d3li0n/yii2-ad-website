<?php
namespace frontend\models;

use Exception;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $firstName;
    public $lastName;
    public $username;
    public $email;
    public $password;
    public $confirmPassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'confirmPassword'], 'required'],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password', 'match', 'pattern' => '/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,25}$/', 'message' => 'Your password should contain at least one number and one special character and it should be minimum 8'],
            ['confirmPassword', 'match', 'pattern' => '/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,25}$/', 'message' => 'Your password should contain at least one number and one special character and it should be minimum 8'],

            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords should match.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        try {
            if (!$this->validate()) {
                return null;
            }

            $user = new User();

            $uuid4 = Uuid::uuid4()->toString();
            $token = $user->generateEmailVerificationToken();
            $authKey = $user->generateAuthKey();
            $hash = $user->setPassword($this->password);

            Yii::$app->db->createCommand()->insert('user', [
                'id' => $uuid4,
                'username' => $this->username,
                'auth_key' => $authKey,
                'password_hash' => $hash,
                'created_at' => time(),
                'updated_at' => time(),
                'email' => $this->email,
                'status' => User::STATUS_INACTIVE,
                'verification_token' => $token,
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
            ])->execute();

            return $this->sendEmail($user);
        } catch(Exception $e) {
            echo $e;
            Yii::$app->session->setFlash('error', 'There was error with registering your account.');
        }
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
