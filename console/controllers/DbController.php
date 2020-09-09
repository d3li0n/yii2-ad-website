<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use yii\db\Exception;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DbController extends Controller
{
    public $city = [
        'Kiev',
        'Charkov',
        'Lviv',
        'Gitomir',
        'Chernigov',
        'Odesa',
        'Kiev',
        'Charkov',
        'Lviv',
        'Gitomir',
        'Chernigov',
        'Odesa',
        'Kiev',
        'Charkov',
        'Lviv',
        'Gitomir',
        'Chernigov',
        'Odesa',
    ];
    public $messages = [
        'Hi there! Thank you for calling us, finally! Olivia is here for you',
        'Hello! This is Irene. Don’t be afraid to ask stupid questions. I love them!',
        'Greetings! I’m Megan. Any questions? You are at the right place!',
        'Hi! This is Maria, your customer service rep. I’m sure we’ll get on really well.',
        'Hi, Irene here. I’m fine, and you?',
        'Hi, this is Julie. Your problems – my problems.',
        'Hello and welcome! I am Olga, you are in good hands now!',
        'Hello! This is Olivia. I know you came to chat with me! I am ready!',
        'Hello! I am Alexa, standing by to get your issues fixed and questions vanished',
        'Hi! Thank you for chatting. This is Mary. I promise to take good care of you!',
        'Greetings! You are chatting with Helen. Please be nice to her.',
        'Hello, I’m awesome. How can I help you?',
        'Hi! Julie here, thanks for chatting! What’s up?',
        'Hi! This is Mary. I was so bored. Thank you for saving me!',
        'Hi! You have called at the right time! Megan online with you.',
        'Hi! Thank you for calling! This is Maria. I’ve been expecting you!',
    ];
    public $name = ['Ivan', 'Petro', 'Semen', 'Stapan', 'Gritsko', 'Grisha', 'Andrey', 'Rostik', 'Dima', 'Anton', 'Ilya', 'Roman', 'Sergey', 'Aleksandr'];
    public $category = [
        'Child`s world',
        'The property',
        'Transport',
        'Spare parts for transport',
        'Job',
        'Animals',
        'A house and a garden',
        'Electronics',
        'Business and Services',
        'Fashion & Style',
        'Hobbies, leisure and sport',
        'I ll give it for free',
        'Exchange',
        'Delivery without commission',
        'Daily rental housing',
    ];

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $this->actionInstall();
        //self::uninstall();
    }

    public function actionInstall()
    {
        $i = 0;
        $imax = 12;

        while ($i < $imax) {
            $id[] = rand(10000, 100000000);

            try {
                $user_uuid[] = Uuid::uuid4()->toString();
                $category_uuid[] = Uuid::uuid4()->toString();
                $city_uuid[] = Uuid::uuid4()->toString();
                $admin_uuid[] = Uuid::uuid4()->toString();
                $ad_uuid[] = Uuid::uuid4()->toString();
                $ad_image_uuid[] = Uuid::uuid4()->toString();
                $ad_moderation_request_uuid[] = Uuid::uuid4()->toString();
                $like_uuid[] = Uuid::uuid4()->toString();
                $favorite_uuid[] = Uuid::uuid4()->toString();
                $chat_uuid[] = Uuid::uuid4()->toString();
                $message_uuid[] = Uuid::uuid4()->toString();
                $param_uuid[] = Uuid::uuid4()->toString();
                $messages = rand(0, count($this->messages)-1);
                $category = rand(0, count($this->category)-1);

                $i++;
            } catch (UnsatisfiedDependencyException $e) {
                echo 'init: ' . $e->getMessage() . "\n";
            }
        }

        $i = 0;
        while ($i < $imax) {
            try {
                echo $this->user($user_uuid[$i], $id[$i]);
                echo $this->category($category_uuid[$i], $category);
                echo $this->city($city_uuid[$i], $this->city[$i]);
                echo $this->admin($admin_uuid[$i]);
                echo $this->ad($ad_uuid[$i], $user_uuid[$i], $category_uuid[$i], $city_uuid[$i],$ad_image_uuid[$i], $messages);
                echo $this->ad_image($ad_image_uuid[$i], $ad_uuid[$i]);
                echo $this->ad_moderation_request($ad_moderation_request_uuid[$i], $ad_uuid[$i], $admin_uuid[$i]);
                echo $this->like($like_uuid[$i], $user_uuid[$i], $ad_uuid[$i]);
                echo $this->favorite($favorite_uuid[$i], $user_uuid[$i], $ad_uuid[$i]);

                echo $this->param($param_uuid[$i]);
            } catch (UnsatisfiedDependencyException $e) {
                echo 'base table: ' . $e->getMessage() . "\n\t";
            }
            $i++;
        }

        $i = 0;
        while ($i < $imax) {
            try {
                $user1 = rand(0, count($ad_uuid)-1);
                $user2 = rand(0, count($ad_uuid)-1);
                $ad = rand(0, count($ad_uuid)-1);

                echo $this->chat($chat_uuid[$i], $ad_uuid[$ad], $user_uuid[$user1], $user_uuid[$user2]);
                echo $this->message($message_uuid[$i], $chat_uuid[$i], $user_uuid[$user1], $user_uuid[$user2],$messages);
            } catch (UnsatisfiedDependencyException $e) {
                echo 'Message exception: ' . $e->getMessage() . "\n\t";
            }
            $i++;
        }
    }

    public function actionUninstall()
    {
        try {
            Yii::$app->db->createCommand()
                ->delete('user')
                ->delete('category')
                ->delete('city')
                ->delete('admin')
                ->delete('ad')
                ->delete('ad_image')
                ->delete('ad_moderation_request')
                ->delete('favorite')
                ->delete('chat')
                ->delete('message')->execute();
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        } catch (\yii\base\Exception $e) {
            echo 'DB/install User hash: ' . $e->getMessage() . "\n";
        }
    }

    public function user($user_uuid, $id)
    {
        try {
            $auth_key = Yii::$app->security->generateRandomString();
            $password_hash = Yii::$app->security->generatePasswordHash('username' . $id . '1');
            $name1 = rand(0, count($this->name)-1);
            $name2 = rand(0, count($this->name)-1);
            $phone = rand(1111111,9999999);

            Yii::$app->db->createCommand()->insert('user', [
                'id' => $user_uuid,
                'username' => 'username' . $user_uuid,
                'auth_key' => $auth_key,
                'password_hash' => $password_hash,
                'password_reset_token' => $auth_key . '_' . time(),
                'email' => 'email' . $user_uuid . '@gmail.com',
                'status' => 9,
                'created_at' => time(),
                'updated_at' => time(),
                'verification_token' => null,
                'mobile' => '38097' . $phone,
                'first_name' => $this->name[$name1],
                'last_name' => $this->name[$name2],
                'is_active' => true,
                'last_login' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        } catch (\yii\base\Exception $e) {
            echo 'DB/install User hash: ' . $e->getMessage() . "\n";
        }
        return '\n\t user';
    }

    public function category($category_uuid, $category)
    {
        try {
            Yii::$app->db->createCommand()->insert('category', [
                'id' => $category_uuid,
                'parent_id' => $category_uuid,
                'name' => $this->category[$category] . $category_uuid,
                'is_active' => true,
                'created_time' => time(),
                'depth' => 2,
            ])->execute();
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
        return '\n\t category';
    }

    public function city($city_uuid, $city)
    {
        try {
            Yii::$app->db->createCommand()->insert('city', [
                'id' => $city_uuid,
                'name' => $city,
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
        return '\n\t city ';
    }

    public function admin($admin_uuid)
    {
        try {
            $password_hash = Yii::$app->security->generatePasswordHash('admin' . $admin_uuid . '1');

            Yii::$app->db->createCommand()->insert('admin', [
                'id' => $admin_uuid,
                'email' => 'admin' . $admin_uuid . '@gmail.com',
                'password_hash' => $password_hash,
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'Admin exception: ' . $e->getMessage() . "\n";
        }
        return '\n\t admin';
    }

    public function ad($ad_uuid, $user_uuid, $category_uuid, $city_uuid, $ad_image_uuid, $messages)
    {
        try {
            $price = rand(5, 270);

            Yii::$app->db->createCommand()->insert('{{%ad}}', [
                'id' => $ad_uuid,
                'user_id' => $user_uuid,
                'title' => $this->messages[$messages],
                'description' => $this->messages[$messages] . $this->messages[$messages] . $this->messages[$messages],
                'category_id' => $category_uuid,
                'status_id' => 1,
                'country' => 'Ukraine',
                'city_id' => $city_uuid,
                'main_image' => 'name' . $ad_image_uuid . '.gif',
                'price' => $price,
                'created_time' => time(),
                'updated_time' => time(),
                'reason_id' => 2,
            ])->execute();
        } catch (Exception $e) {
            echo 'Ad exception: ' . $e->getMessage() . "\n";
        }
        return '\n ad ';
    }

    public function ad_image($ad_image_uuid, $ad_uuid)
    {
        try {
            Yii::$app->db->createCommand()->insert('ad_image', [
                'id' => $ad_image_uuid,
                'ad_id' => $ad_uuid,
                'created_time' => time(),
                'name' => 'name' . $ad_image_uuid . '.gif',
            ])->execute();
        } catch (Exception $e) {
            echo 'ad_image exception: ' . $e->getMessage() . "\n";
        }
        return '\n ad_image ';
    }

    public function ad_moderation_request($ad_moderation_request_uuid, $ad_uuid, $admin_uuid)
    {
        try {
            Yii::$app->db->createCommand()->insert('ad_moderation_request', [
                'id' => $ad_moderation_request_uuid,
                'ad_id' => $ad_uuid,
                'moderator_id' => $admin_uuid,
                'status_id' => 1,
                'reason_id' => 1,
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'ad_moderation_request exception: ' . $e->getMessage() . "\n";
        }
        return '\n ad_moderation_request ';
    }

    public function like($like_uuid, $user_uuid, $ad_uuid)
    {
        try {
            Yii::$app->db->createCommand()->insert('like', [
                'id' => $like_uuid,
                'user_id' => $user_uuid,
                'ad_id' => $ad_uuid,
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'like exception: ' . $e->getMessage() . "\n";
        }
        return '\n like ';
    }

    public function favorite($favorite_uuid, $user_uuid, $ad_uuid)
    {
        try {
            Yii::$app->db->createCommand()->insert('favorite', [
                'id' => $favorite_uuid,
                'user_id' => $user_uuid,
                'ad_id' => $ad_uuid,
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'favorite exception: ' . $e->getMessage() . "\n";
        }
        return '\n favorite ';
    }

    public function chat($chat_uuid, $ad_uuid, $user_uuid1, $user_uuid2)
    {
        try {
            Yii::$app->db->createCommand()->insert('chat', [
                'id' => $chat_uuid,
                'ad_id' => $ad_uuid,
                'user_from' => $user_uuid1,
                'user_to' => $user_uuid2,
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'Chat exception: ' . $e->getMessage() . "\n";
        }
        return '\n chat';
    }

    public function message($message_uuid, $chat_uuid, $user_uuid1, $user_uuid2, $message_id)
    {
        try {
            Yii::$app->db->createCommand()->insert('message', [
                'id' => $message_uuid,
                'chat_id' => $chat_uuid,
                'user_from' => $user_uuid1,
                'user_to' => $user_uuid2,
                'text' => $this->messages[$message_id],
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'message exception: ' . $e->getMessage() . "\n";
        }
        return '\n message';
    }

    public function param($param_uuid)
    {
        try {
            Yii::$app->db->createCommand()->insert('param', [
                'id' => $param_uuid,
                'name' => 'name' . $param_uuid,
                'type' => 'type' . $param_uuid,
                'value' => 'value' . $param_uuid,
                'created_time' => time(),
            ])->execute();
        } catch (Exception $e) {
            echo 'param exception: ' . $e->getMessage() . "\n";
        }
        return '\n param ';
    }

}
