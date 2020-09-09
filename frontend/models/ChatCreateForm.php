<?php

namespace frontend\models;

use common\models\Ad;
use common\models\Chat;
use Exception;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class ChatCreateForm extends Model
{
    public $message;

    public function rules()
    {
        return [
            ['message', 'required'],
            ['message', 'string', 'min' => 4, 'skipOnEmpty' => false, 'message' => 'Your text should be at least 4 symbols'],
        ];
    }

    /**
     * @param $param
     */
    public function createChat($param)
    {
        try {
            if($this->doesChatExist($param)) {
                Yii::$app->session->setFlash('success', 'You have send the message to the seller.');
                return $this->addMessage($param);
            }
            $uuid4 = Uuid::uuid4()->toString();

            $user = $this->getAdOwner($param)->user_id;

            Yii::$app->db->createCommand()->insert('chat', [
                'id' => $uuid4,
                'ad_id' => $param,
                'user_from' => Yii::$app->user->getId(),
                'user_to' => $user,
                'created_time' => time(),
            ])->execute();

            $this->addMessage($param);
            Yii::$app->session->setFlash('success', 'You have send the message to the seller.');
        } catch(Exception $e) {
            Yii::$app->session->setFlash('error', 'Message was not sent due to the server error. This problem was sent to the system team.');
        }
    }

    /**
     * @param $param
     * @return bool
     */
    public function doesChatExist($param)
    {
        if(!is_null($this->getChatId($param))) {
            return true;
        }

        return false;
    }

    /**
     * @param $param
     * @throws Exception
     */
    public function addMessage($param)
    {
        try {
            $uuid4 = Uuid::uuid4()->toString();

            $user = $this->getAdOwner($param)->user_id;

            Yii::$app->db->createCommand()->insert('message', [
                'id' => $uuid4,
                'chat_id' => $this->getChatId($param)->id,
                'user_from' => Yii::$app->user->getId(),
                'user_to' => $user,
                'text' => $this->message,
                'created_time' => time(),
            ])->execute();

        } catch(Exception $e) {

        }
    }

    /**
     * @param $param
     * @return array|Chat|ActiveRecord|null
     */
    public function getChatId($param)
    {
        return Chat::find()->where(['ad_id' => $param, 'user_from' => Yii::$app->user->getId()])->one();
    }

    /**
     * @param $param
     * @return array|Ad|ActiveRecord|null
     */
    public function getAdOwner($param)
    {
        return Ad::find()->where(['id' => $param])->one();
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'message' => '',
        ];
    }
}