<?php

namespace frontend\models;

use common\models\Chat;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;
use yii\db\Query;

class MessageSendForm extends Model
{
    public $message;

    public function rules()
    {
        return [
            ['message', 'required'],
            ['message', 'string', 'min' => 4, 'skipOnEmpty' => false, 'message' => 'Your text should be at least 4 symbols'],
        ];
    }

    public function sendMessage($param)
    {
        $uuid4 = Uuid::uuid4()->toString();

        if ($this->getUser($param)->user_from === Yii::$app->user->getId()) {
            $user = $this->getUser($param)->user_to;
        } else {
            $user = $this->getUser($param)->user_from;
        }
        Yii::$app->db->createCommand()->insert('message', [
            'id' => $uuid4,
            'chat_id' => $param,
            'user_from' => Yii::$app->user->getId(),
            'user_to' => $user,
            'text' => $this->message,
            'created_time' => time(),
        ])->execute();
    }

    public function getUser($param)
    {
        return Chat::findOne(['id' => $param]);
    }

    public function attributeLabels()
    {
        return [
            'message' => '',
        ];
    }
}