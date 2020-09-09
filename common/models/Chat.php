<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chat".
 *
 * @property string $id
 * @property string $ad_id
 * @property string $user_from
 * @property string $user_to
 * @property int $created_time
 *
 * @property Ad $ad
 * @property User $userFrom
 * @property User $userTo
 * @property Message[] $messages
 *
 * @property Message[] $message
 * @property Message[] $text
 */
class Chat extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ad_id', 'user_from', 'user_to', 'created_time'], 'required'],
            [['id', 'ad_id', 'user_from', 'user_to'], 'string'],
            [['created_time'], 'default', 'value' => null],
            [['created_time'], 'integer'],
            [['id'], 'unique'],
            [['ad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ad::class, 'targetAttribute' => ['ad_id' => 'id']],
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
            'ad_id' => 'Ad ID',
            'user_from' => 'User From',
            'user_to' => 'User To',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAd()
    {
        return $this->hasOne(Ad::class, ['id' => 'ad_id']);
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

    /**
     * @return ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::class, ['chat_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::class, ['chat_id' => 'id'])->orderBy(['created_time' => SORT_DESC]);
    }
}
