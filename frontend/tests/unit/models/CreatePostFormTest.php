<?php
namespace frontend\tests\unit\models;

use frontend\models\CreatePostForm;
use Ramsey\Uuid\Uuid;
use Yii;

class CreatePostFormTest extends \Codeception\Test\Unit
{
    public function testCreatePost()
    {
        $model = new CreatePostForm();

        $uuid4 = Uuid::uuid4()->toString();
        $user_id = Yii::$app->user->id;

        $model->attributes = [
            'id' => $uuid4,
            'title' => 'Teste Title',
            'description' => 'test description in new test ads. test description in new test ads. test description in new test ads. ',
            'category_id' => '068f0235-da4f-40b9-987d-3249e8f92677',
            'country' => 'Ukraine',
            'city_id' => '2bf71a92-e3f9-4571-b0f1-43067442d927',
            'price' => '154',
            'main_image' => 'main_ad.gif',
            'reason_id' => 1,
            'user_id' => $user_id,
            'status_id' => 1,
            'is_negotiable' => false,
            'created_time' => time(),
        ];

        $this->tester->createPost();
    }
}
