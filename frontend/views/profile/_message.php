<?php

// _message.php

use frontend\models\ChatModule;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var ChatModule $model
 */
?>

<div class="tab-pane" id="pills-messages" role="tabpanel" aria-labelledby="pills-contact-tab">
    <a href="<?php echo Url::to(['/conversation', 'm' => $model->id]); ?>" class="d-flex border-bottom p-3">
        <div class="img-small-wrapper mr-3">
            <?php echo Html::img(Html::encode($model->ad->main_image), ['alt' => 'user post img']); ?>
        </div>
        <div class="w-75">
            <h4 class="h4"><?php echo Html::encode($model->ad->title); ?></h4>
            <p class="text-truncate">
                <?php
                    if($model->message->user_from === Yii::$app->user->identity->getId()) {
                        echo Html::encode('Вы: ');
                    } else {
                        echo Html::encode('Покупатель: ');
                    }
                    echo Html::encode($model->message->text);
                ?>
            </p>
        </div>
    </a>
</div>
