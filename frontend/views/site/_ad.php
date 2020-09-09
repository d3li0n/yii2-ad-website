<?php

use frontend\models\AdService;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var AdService $model
 */
?>
<div class="col-sm-4">
    <?php
        $content = '<div class="h-50">' . Html::img(Html::encode($model->main_image), ['alt' => 'user post', 'class' => 'card-img-top']) . '</div>';
        $content .= '<div class="card-body p-2 mt-2">';
        $content .= '<h5 class="h5 card-title mb-2">' . Html::encode($model->title) . '</h5>';
        $content .= '<p class="card-text description mb-3">' . Html::encode($model->description) . '</p>';
        $content .= '<p class="card-text font-weight-bold mb-2"><span class="bg-info text-light p-1">Price: ' . Html::encode($model->price) . ' USD </span></p></div>';
    ?>

    <?php echo Html::a($content, Url::to(['/ad', 'id' => $model->id]), ['class' => 'card mb-3 mr-2']); ?>
</div>