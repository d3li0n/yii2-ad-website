<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "inquire".
 *
 * @property string $id
 * @property string $email
 * @property int $mobile
 * @property string $content
 * @property int $created_time
 */
class Inquire extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inquire';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'email', 'mobile', 'content', 'created_time'], 'required'],
            [['id'], 'string'],
            [['mobile', 'created_time'], 'default', 'value' => null],
            [['mobile', 'created_time'], 'integer'],
            [['email', 'content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'content' => 'Content',
            'created_time' => 'Created Time',
        ];
    }
}
