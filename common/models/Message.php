<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property string $chat_id
 * @property string $user_from
 * @property string $user_to
 * @property string $text
 * @property int $created_time
 *
 * @property Chat $chat
 * @property User $userFrom
 * @property User $userTo
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'chat_id', 'user_from', 'user_to', 'text', 'created_time'], 'required'],
            [['id', 'chat_id', 'user_from', 'user_to', 'text'], 'string'],
            [['created_time'], 'default', 'value' => null],
            [['created_time'], 'integer'],
            [['id'], 'unique'],
            [['chat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chat::class, 'targetAttribute' => ['chat_id' => 'id']],
            [['user_from'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_from' => 'id']],
            [['user_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_to' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'user_from' => 'User From',
            'user_to' => 'User To',
            'text' => 'Text',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getChat()
    {
        return $this->hasOne(Chat::class, ['id' => 'chat_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUserFrom()
    {
        return $this->hasOne(User::class, ['id' => 'user_from']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUserTo()
    {
        return $this->hasOne(User::class, ['id' => 'user_to']);
    }
}
