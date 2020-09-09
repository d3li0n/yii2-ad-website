<?php


namespace frontend\models;

use common\models\Chat;
use common\models\Message;
use Yii;
use yii\data\ActiveDataProvider;

class ChatModule extends Chat
{
    /**
     * @param $param
     * @return ActiveDataProvider
     */
    public function loadAd($param)
    {
        $query = Chat::find()->where(['id' => $param])->with('ad');

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $provider;
    }

    /**
     * @param $param
     * @return ActiveDataProvider
     */
    public function loadMessages($param)
    {
        $query = Message::find()->where(['chat_id' => $param]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_time' => SORT_ASC,
                ],
            ]
        ]);

        return $provider;
    }

    /**
     * @return ActiveDataProvider
     */
    public function search()
    {
        $message = Chat::find()->where([
            'user_from' => Yii::$app->user->identity->getId(),
        ])->orWhere([
            'user_to' => Yii::$app->user->identity->getId(),
        ])->with('ad')->with('userFrom');

        $provider = new ActiveDataProvider([
            'query' => $message,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_time' => SORT_DESC,
                ],
            ]
        ]);

        return $provider;
    }
}