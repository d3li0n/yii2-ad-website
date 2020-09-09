<?php


namespace frontend\controllers;

use frontend\models\AdService;
use common\models\Ad;
use common\models\City;
use frontend\models\ChatCreateForm;
use frontend\models\CreatePostForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\Category;

class AdController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['view'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create-post'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
    * Displays create post page.
    *
    * @return mixed
    */
    public function actionCreatePost()
    {
        $question_category = Category::find()->all();
        $category = ArrayHelper::map($question_category,'id','name');

        $question_ciry = City::find()->all();
        $city = ArrayHelper::map($question_ciry,'id','name');

        $model = new CreatePostForm();

        if (Yii::$app->request->isPost) {

            //TODO $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            //!!!!!!!!!!!!!!!!!!!!!dont use this function. This is example of image UPLOAD
            /*$model->uploadImage('0c170aa4-c44b-462a-a582-429824f3fa38');

            if ($model->uploadImage()) {
                Yii::$app->session->setFlash('success', 'Add img in post.');

                if ($model->createPost()) {
                    Yii::$app->session->setFlash('success', 'Add your post.');
                    //return $this->goHome();
                }
            }*/

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if($model->createPost()) {
                    return $this->goHome();
                    Yii::$app->session->setFlash('success', 'Ad Added!');
                }
            }
        } else {
            return $this->render('createPost', ['model' => $model, 'category' => $category, 'city' => $city]);
        }

        return $this->render('createPost', [
            'model' => $model, 'category' => $category, 'city' => $city
        ]);
    }

    public function actionView()
    {
        $param = Yii::$app->getRequest()->getQueryParam('id');

        if (empty($param)) {
            $this->goHome();
        }

        $adComponents = new AdService();
        $chat = new ChatCreateForm();

        $adInfo = $adComponents->loadAdByParameter($param);

        if (Yii::$app->user->isGuest) {
            $categoryAd = $adComponents->loadAdByCategory($param, 4);

            return $this->render('ad-view', [
                'modelad' => null,
                'adModel' => $adInfo,
                'model' => $categoryAd,
                'message' => $chat,
            ]);
        } else {
            $myAd = $adComponents->loadAdById(4);

            $categoryAd = $adComponents->loadAdByCategory($param, 4);

            if ($chat->load(Yii::$app->request->post())) {
                if ($chat->validate()) {
                    $chat->createChat($param);

                    return Yii::$app->controller->refresh();
                }
            }

            return $this->render('ad-view', [
                'adModel' => $adInfo,
                'modelad' => $myAd,
                'model' => $categoryAd,
                'message' => $chat,
            ]);
        }
    }
}