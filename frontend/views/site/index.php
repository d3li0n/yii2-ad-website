<?php

/* @var $this yii\web\View */

use frontend\models\AdService;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var $model AdService
 * @var $category \common\models\Category
 **/
?>

<!--<section class="container mt-5 pb-3 border-bottom">
    <h2 class="h4 mb-3">Filters</h2>-->
    <?php /*$form = ActiveForm::begin(['id' => 'search-2', 'options' => ['enctype' => 'multipart/form-data'/*,'method' => 'get', 'class' => 'd-flex align-items-center']]); */?><!--

        <?php /*echo $form->field($model, 'category_id')->dropDownList($category, ['id' => 'category_id', 'style' => 'width: 300px;']) */?>

        <?php /*echo $form->field($model, 'price_from')->textInput(['class' => 'form-control input-price ml-3 mr-2', 'placeholder' => 'Price from']); */?>

        <?php /*echo $form->field($model, 'price_to')->textInput(['class' => 'form-control input-price mr-2', 'placeholder' => 'Price to']); */?>

        <?php /*echo $form->field($model, 'currency')->dropDownList(['usd','eur'], ['id' => 'currency']) */?>

        <?php /*echo Html::submitButton('Search', ['class' => 'btn btn-success ml-2']) */?>
    --><?php /*ActiveForm::end();*/ ?>
<!--</section>-->

<section class="container pt-4 mb-5">
    <h2 class="h2 mb-4">New ads</h2>
    <div class="row">
        <?php
            try {

                /** @var AdService $model */
                echo ListView::widget([
                    'dataProvider' => $model,
                    'itemView' => '_ad',
                    'summary' => '',
                    'layout' => '{items}</div><div class="center-block">{pager}</div>{summary}',
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
                        'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
                        'maxButtonCount' => 5,
                    ],
                ]);
            } catch(Exception $e) {
                echo 'Ads are not loaded or does not exist.';
            }
        ?>
    </div>
</section>
