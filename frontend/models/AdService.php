<?php

namespace frontend\models;

use common\models\Ad;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class AdService extends Ad
{
    /**
     * @param $param
     * @return bool|int|string
     */
    public function pushAd($param)
    {
        try {
            if ($this->validateAdParameter($param)) {
                return Yii::$app->db->createCommand()->update('ad', [
                    'updated_time' => time(),
                ], ['id' => $param])->execute();
            }
            return false;
        } catch (Exception $e) {
            return 'Something went wrong.';
        }
    }

    /**
     * @param $param
     * @return bool
     */
    public function validateAdParameter($param)
    {
        $query = Ad::find()->where(['id' => $param])->one();

        $response = $query->updated_time;

        if (time() >= ($response + 86400)) {
            if ($query->user_id === Yii::$app->user->getId()) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * @param $param
     * @return array|Ad|string|ActiveRecord|null
     */
    public function loadAdByParameter($param)
    {
        try {
            return Ad::find()->where(['id' => $param])->with('adImages')->with('user')->with('category')->with('city')->one();
        } catch(Exception $e) {
            return 'Something went wrong.';
        }
    }

    /**
     * @param $param
     * @param $limit
     * @return ActiveDataProvider
     */
    public function loadAdByCategory($param, $limit)
    {
        $query = $this->loadAdByParameter($param);

        $ad = Ad::find()->where([
            'category_id' => $query->category_id,
        ])->limit($limit);

        $provider = new ActiveDataProvider([
            'query' => $ad,
            'pagination' => [
                'pageSize' => 4,
            ],
            'sort' => [
                'defaultOrder' => [
                    'updated_time' => SORT_ASC,
                ],
            ]
        ]);

        return $provider;
    }

    /**
     * @param $limit
     * @return ActiveDataProvider
     */
    public function loadAdById($limit = null)
    {
        if($limit === 4) {
            $ad = Ad::find()->where([
                'user_id' => Yii::$app->user->identity->getId(),
            ])->limit($limit);

            $provider = new ActiveDataProvider([
                'query' => $ad,
                'pagination' => [
                    'pageSize' => 4,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'updated_time' => SORT_ASC,
                    ],
                ]
            ]);

            return $provider;
        }

        $ad = Ad::find()->where([
            'user_id' => Yii::$app->user->identity->getId(),
        ]);

        $provider = new ActiveDataProvider([
            'query' => $ad,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'updated_time' => SORT_ASC,
                ],
            ]
        ]);

        return $provider;
    }

    public function searchAdByText($param)
    {
        $ad = Ad::find()->andWhere(['or', ['like', 'description', $param]]);

        $provider = new ActiveDataProvider([
            'query' => $ad,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'updated_time' => SORT_ASC,
                ],
            ]
        ]);

        return $provider;
    }

    /**
     * @return ActiveDataProvider
     */
    public function loadAds()
    {
        $provider = new ActiveDataProvider([
            'query' => Ad::find()->where(['status_id' => 1]),
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort' => [
                'defaultOrder' => [
                    'updated_time' => SORT_ASC,
                ],
            ]
        ]);

        return $provider;
    }
}