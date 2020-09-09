<?php

namespace frontend\controllers;

use frontend\models\AdService;
use frontend\models\ChatModule;
use frontend\models\EmailChangeForm;
use frontend\models\PasswordChangeForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class ProfileController extends Controller
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
                        'actions' => ['posts', 'messages', 'update-ad', 'update-email','update-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string|Response
     * Posts
     */
    public function actionPosts()
    {
        $provider = new AdService();
        $provider = $provider->loadAdById();

        return $this->render('posts', [
            'model' => $provider,
        ]);
    }

    /**
     * @return string|Response
     * Messages
     */
    public function actionMessages()
    {
        $provider = new ChatModule();
        $provider = $provider->search();

        $ad = new AdService();
        $ad = $ad->loadAdById();

        return $this->render('messages', [
            'model' => $provider,
            'ad' => $ad,
        ]);
    }

    public function actionUpdateAd()
    {
        $push = new AdService();

        $param = Yii::$app->request->get('id');

        if ($push->pushAd($param)) {
            Yii::$app->getSession()->setFlash(
                'success', 'Ad has been pushed up'
            );

            return $this->goBack('my-posts');
        }

        Yii::$app->getSession()->setFlash(
            'error', 'We could not push your ad for free.'
        );
        return $this->goBack('my-posts');
    }

    /**
     * @return string|Response
     */
    public function actionUpdatePassword()
    {
        $passwordChange = new PasswordChangeForm();

        if ($passwordChange->load(Yii::$app->request->post())) {
            if ($passwordChange->validate()) {
                $passwordChange->updatePassword();
                return Yii::$app->controller->refresh();
            } else {
                return $this->render('passwordChange', [
                    'password' => $passwordChange,
                ]);
            }
        }

        return $this->render('passwordChange', [
            'password' => $passwordChange,
        ]);
    }

    /**
     * @return string|Response
     * Settings
     */
    public function actionUpdateEmail()
    {
        $emailChange = new EmailChangeForm();

        if ($emailChange->load(Yii::$app->request->post())) {
            if ($emailChange->validate()) {
                $emailChange->updateEmail();
                return Yii::$app->controller->refresh();
            } else {
                return $this->render('emailChange', [
                    'email' => $emailChange,
                ]);
            }
        }

        return $this->render('emailChange', [
            'email' => $emailChange,
        ]);
    }
}