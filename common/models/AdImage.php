<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ad_image".
 *
 * @property string $id
 * @property string $name
 * @property string $ad_id
 * @property int $created_time
 *
 * @property Ad $ad
 */
class AdImage extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ad_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'ad_id', 'created_time'], 'required'],
            [['id', 'ad_id'], 'string'],
            [['created_time'], 'default', 'value' => null],
            [['created_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['ad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ad::class, 'targetAttribute' => ['ad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'ad_id' => 'Ad ID',
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
}
