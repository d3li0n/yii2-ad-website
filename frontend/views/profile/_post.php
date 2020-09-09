<?php
// _post.php

use frontend\models\AdService;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var AdService $model
 */
?>

<div class="tab-pane show active" id="pills-posts" role="tabpanel" aria-labelledby="pills-home-tab">
    <a href="ad?id=<?php echo Html::encode($model->id); ?>" class="d-flex border-bottom p-3">
        <div class="img-small-wrapper mr-3">
            <?php echo Html::img(Html::encode($model->main_image)) ?>
        </div>
        <p class="account-ad-text w-75"><?php echo Html::encode($model->description); ?></p>
        <?php if(time() >= ($model->updated_time + 86400)) { ?>
            <?php
                $form = ActiveForm::begin([
                        'action' => 'push?id=' . $model->id,
                ]); ?>

                <?php echo Html::submitButton('Free push up', ['class' => 'btn btn-info']); ?>

            <?php ActiveForm::end(); ?>

        <?php } ?>
    </a>
</div>
