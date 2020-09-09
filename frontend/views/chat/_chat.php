<?php

// _chat.php

use frontend\models\ChatModule;
use yii\helpers\Html;

/**
 * @var ChatModule $model
 */

if($model->user_from === Yii::$app->user->identity->getId()) { ?>
    <div class="w-100 alert mt-2 mb-4">
        <span class="p-3 alert-primary float-right">
            <?php echo Html::encode($model->text); ?>
        </span>
    </div>
<?php } else { ?>
    <div class="w-100 alert">
        <span class="p-3 alert-success">
            <?php echo Html::encode($model->text); ?>
        </span>
    </div>
<?php } ?>
