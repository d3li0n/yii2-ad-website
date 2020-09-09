<?php

use frontend\models\AdService;
use frontend\models\MessageSendForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var AdService $modelad
 * @var AdService $model
 * @var AdService $adModel
 * @var MessageSendForm $message
 */

?>

<section class="container mt-5 w-75 m0-auto mb-3 border-bottom">
    <?php if(!empty($adModel->adImages)) { ?>
        <div class="swiper-container detail-view-slider center-block">
            <div class="swiper-wrapper">
                <?php
                    foreach ($adModel->adImages as $image) {
                        echo '<div class="swiper-slide">' . Html::img(Html::encode($image->name)). '</div>';
                    }
                ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    <?php } ?>

    <h2 class="h5 mb-3 mt-3 font-weight-bold"><?php echo Html::encode($adModel->title); ?></h2>

    <p><?php echo Html::encode($adModel->description); ?></p>

    <ul class="list-unstyled d-flex flex-wrap mt-3 mb-3">
        <li class="w-50 pr-2 mb-2"><span class="font-weight-bold">Category: </span><?php echo Html::encode($adModel->category->name); ?></li>
        <li class="w-50 pr-2 mb-2"><span class="font-weight-bold">Price: </span><span class="bg-info text-light p-1"><?php echo Html::encode($adModel->price); ?> USD</span></li>
        <li class="w-50 pr-2 mb-2"><span class="font-weight-bold">Posted by: </span><?php echo Html::encode($adModel->user->first_name) . ' ' . Html::encode($adModel->user->last_name); ; ?></li>
        <li class="w-50 pr-2 mb-2"><span class="font-weight-bold">City: </span><?php echo Html::encode($adModel->city->name); ?></li>
    </ul>

    <div class="w-75 m0-auto mt-5">

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php endif; ?>

        <?php
            if(!Yii::$app->user->isGuest) {
                if (Yii::$app->user->getId() != $adModel->user_id) {
                    echo '<label for="user-chat" class="font-weight-bold text-center">Write me!</label>';
                    $form = ActiveForm::begin([
                        'id' => 'sendmessage-form',
                        'class' => 'form-group text-center d-flex flex-column',
                        'options' => ['class' => 'form-horizontal'],
                        'method' => 'post',
                    ]);
                    echo $form->field($message, 'message', ['inputOptions' => [
                        'placeholder' => 'Enter your message', [
                            'class' => 'md-textarea',
                            'id' => 'user-chat'
                        ]
                    ]])->textarea();

                    echo Html::submitButton('Send', [
                        'class' => 'btn btn-info float-right mb-4'
                    ]);
                    ActiveForm::end();
                }
            }
        ?>
    </div>
</section>

<?php if (!Yii::$app->user->isGuest) { ?>
<section class="container w-75 m0-auto border-bottom mb-3">
    <h3 class="h3 mb-4">Your Last Ads</h3>

    <div class="row">
        <?php
            try {
                echo ListView::widget([
                    'dataProvider' => $modelad,
                    'itemView' => '_ad',
                    'summary' => '',
                ]);
            } catch (Exception $e) {
                echo 'Ads are not loaded or does not exist.';
            }
        ?>
    </div>
</section>
<?php } ?>
<section class="container w-75 m0-auto border-bottom mb-5">
    <h3 class="h3 mb-4">Ads With Same Category</h3>
    <div class="row">
        <?php
            try {
                echo ListView::widget([
                    'dataProvider' => $model,
                    'itemView' => '_categoryad',
                    'summary' => '',
                ]);
            } catch(Exception $e) {
                echo 'Ads are not loaded or does not exist.';
            }
        ?>
    </div>
</section>