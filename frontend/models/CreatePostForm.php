<?php

namespace frontend\models;

use Exception;
use yii\web\UploadedFile;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CreatePostForm extends Model
{
    public $title;
    public $description;
    public $category_id;
    public $country;
    public $city_id;
    public $price;
    public $main_image;
    /**
     * @var UploadedFile[]
     */
    public $imageFiles = [];
    public $reason_id;
    public $is_negotiable;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id', 'country', 'city_id', 'price', 'is_negotiable'], 'required'],
            //[['imageFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 4, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2],
            [['description', 'category_id', 'city_id'], 'string'],
            [['price'], 'integer'],
            [['is_negotiable'], 'boolean'],
            [['title', 'country'], 'string', 'max' => 255],
            //[['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            //[['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

        ];
    }

    /**
     * $ad as database ad_id
     * @param $ad
     * @return bool
     */
    public function uploadImage($ad)
    {
        try {
            if ($this->validate()) {

                foreach ($this->imageFiles as $file) {

                    $image = 'img/posts-img/' . $file->baseName . '.' . $file->extension;

                    $file->saveAs($image);
                    
                    $this->uploadImageToDatabase($image, $ad);
                }
                return true;
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', 'There was an error uploading your images.');
        }
    }

    /**
     * $param as image path
     * $id as ad_id
     * @param $param
     * @param $id
     * @return bool
     */
    public function uploadImageToDatabase($param, $id)
    {
        try {
            $uuid4 = Uuid::uuid4()->toString();

            Yii::$app->db->createCommand()->insert('ad_image', [
                'id' => $uuid4,
                'name' => $param,
                'ad_id' => $id,
                'created_time' => time(),
            ])->execute();

            return true;

        } catch(Exception $e) {
            Yii::$app->session->setFlash('error', 'There was an error uploading your images.');
        }

    }

    /**
     * Sends an inquire to the database using the information collected by the model.
     */
    public function createPost()
    {
        try {
            $uuid4 = Uuid::uuid4()->toString();
            $user_id = Yii::$app->user->id;

            Yii::$app->db->createCommand()->insert('ad', [
                    'id' => $uuid4,
                    'title' => $this->title,
                    'description' => $this->description,
                    'category_id' => $this->category_id,
                    'country' => $this->country,
                    'city_id' => $this->city_id,
                    'price' => $this->price,
                    //'main_image' => $this->main_images,
                    'reason_id' => 1,//$this->reason_id,
                    'user_id' => $user_id,
                    'status_id' => 1,
                    'is_negotiable' => $this->is_negotiable,
                    'created_time' => time(),
                ])->execute();


            // TODO GET CREATED AD ID FIRST AND PUT INTO THIS FUNCTION
            //$this->uploadImage('0c170aa4-c44b-462a-a582-429824f3fa38');


            //Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');

            //Yii::$app->controller->refresh();
        } catch (Exception $e) {
            //Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            //Yii::$app->controller->refresh();
        }
    }
}
