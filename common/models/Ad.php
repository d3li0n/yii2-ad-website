<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ad".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $user_id
 * @property string $category_id
 * @property int $status_id
 * @property string $country
 * @property string $city_id
 * @property int $price
 * @property int $main_image
 * @property int $reason_id
 * @property int $created_time
 * @property int $updated_time
 * @property bool $is_deleted
 * @property bool $is_negotiable
 *
 * @property Category $category
 * @property City $city
 * @property User $user
 * @property AdImage[] $adImages
 * @property AdModerationRequest[] $adModerationRequests
 * @property Chat[] $chats
 * @property Favorite[] $favorites
 * @property Like[] $likes
 * @property AdImage[] $adImage
 */
class Ad extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'title', 'user_id', 'category_id', 'status_id', 'city_id', 'created_time'], 'required'],
            [['id', 'description', 'user_id', 'category_id', 'city_id'], 'string'],
            [['status_id', 'price', 'reason_id', 'created_time', 'updated_time'], 'default', 'value' => null],
            [['status_id', 'price', 'reason_id', 'created_time', 'updated_time'], 'integer'],
            [['is_deleted', 'is_negotiable'], 'boolean'],
            [['title', 'country', 'main_image'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'status_id' => 'Status ID',
            'country' => 'Country',
            'city_id' => 'City ID',
            'price' => 'Price',
            'main_image' => 'Main Images',
            'reason_id' => 'Reason ID',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'is_deleted' => 'Is Deleted',
            'is_negotiable' => 'Is Negotiable',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAdImages()
    {
        return $this->hasMany(AdImage::class, ['ad_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAdImage()
    {
        return $this->hasOne(AdImage::class, ['ad_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAdModerationRequests()
    {
        return $this->hasMany(AdModerationRequest::class, ['ad_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::class, ['ad_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['ad_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['ad_id' => 'id']);
    }
}
