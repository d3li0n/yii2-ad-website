<?php

namespace frontend\controllers;

use frontend\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        $user = User::find();
        $provider = new ActiveDataProvider([
            'query' => $user,
            'pagination' => [
                'pageSize' => 2,
            ],/*
            'sort' => [
                'defaultOrder' => [
                    'created_time' => SORT_DESC,
                ]
            ]*/
        ]);

        return $provider;
    }

    public function actionView($id)
    {
        $user = User::findOne($id);

        return $user;
    }

    public function actionCreate()
    {
        $user = new User();
        $user->load(\Yii::$app->request->post(), '');
        $user->save();

        return $user;
    }

    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        $user->load(\Yii::$app->request->getBodyParams(), '');
        $user->save();

        return $user;
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);
        $user->delete();

        return $user;
    }

    public function actionSearch($id, $username)
    {
        $user = User::findOne($id);

        return $user;
    }
}
