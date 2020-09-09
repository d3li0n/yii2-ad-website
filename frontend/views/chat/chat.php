<?php

use frontend\models\ChatModule;
use frontend\models\MessageSendForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/**
 * @var ChatModule $ad
 * @var ChatModule $model
 * @var MessageSendForm $message
 */
?>

<section class="container mt-5">
    <div class="w-75 center-block">
        <?php
            try {
                echo ListView::widget([
                    'dataProvider' => $ad,
                    'summary' => '',
                    'itemView' => function ($ad) {
                        $text = Html::img(Html::encode($ad->ad->main_image), [
                                'alt' => 'user post img', 'class' => 'img-small-wrapper mr-3'
                                ]) . '<p class="text-truncate">' . $ad->ad->description . '</p>';

                        echo Html::a($text, Url::to(['/ad', 'id' => $ad->ad->id]), ['class' => 'd-flex border-bottom p-3 align-items-center']);
                    },
                ]);
            } catch (Exception $e) {
                echo 'Something went wrong. Ad Display does not working properly.';
            }
        ?>

        <div class="border-bottom p-4 d-flex flex-column">
            <?php
                try {
                    echo ListView::widget([
                        'dataProvider' => $model,
                        'itemView' => '_chat',
                        'summary' => '',
                        'pager' => [
                            'firstPageLabel' => 'First',
                            'lastPageLabel' => 'Last',
                            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
                            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
                            'maxButtonCount' => 5,
                        ],
                    ]);
                } catch (Exception $e) {
                    echo 'Something went wrong. Chat is not working properly.';
                }
            ?>
        </div>
    </div>

    <div class="center-block w-75 form-group d-flex flex-column mt-3">
        <?php $form = ActiveForm::begin([
            'id' => 'sendmessage-form',
            'class' => 'd-flex flex-column mt-3',
            'options' => ['class' => 'form-horizontal'],
            'method' => 'post',
        ]); ?>

        <?php echo $form->field($message,'message',['inputOptions'=>[
            'placeholder'=>'Type your message', [
                'class' => 'md-textarea ',
            ]
        ]])->textarea(); ?>

        <?php echo Html::submitButton('Send',[
            'class'=>'btn btn-primary mt-3 float-right'
        ]); ?>

        <?php ActiveForm::end(); ?>
    </div>
</section>
