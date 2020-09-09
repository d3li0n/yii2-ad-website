<?php

namespace frontend\controllers;

use frontend\models\ChatModule;
use frontend\models\MessageSendForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class ChatController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $param = Yii::$app->getRequest()->getQueryParam('m');

        if (empty($param)) {
            return $this->goBack('messages');
        }

        $messages = new ChatModule();
        $message = new MessageSendForm();

        $ad = $messages->loadAd($param);
        $messages = $messages->loadMessages($param);

        if ($message->load(Yii::$app->request->post())) {
            if ($message->validate()) {
                $message->sendMessage($param);
                return Yii::$app->controller->refresh();
            }
        }

        return $this->render('chat', [
            'model' => $messages,
            'ad' => $ad,
            'message' => $message,
        ]);
    }
}