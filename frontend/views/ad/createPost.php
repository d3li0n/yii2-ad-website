<?php

use frontend\models\CreatePostForm;
use yii\base\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this View */
/* @var $form ActiveForm */

/**
 * @var $model CreatePostForm
 * @var $category \common\models\Category
 * @var $city \common\models\City
 **/

?>

<section class="container mt-5 w-50 m0-auto mb-5">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <h2 class="h2 text-center">Create your post</h2>
    <?php $form = ActiveForm::begin(['id' => 'create-post-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?php echo $form->field($model, 'title')->textInput(['class' => 'form-control mt-2', 'placeholder' => 'Enter title'])->label('Title', ['class' => 'font-weight-bold']); ?>

            <?php echo $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'form-control mt-2', 'id' => 'description', 'placeholder' => 'Enter description'])->label('Description', ['class' => 'font-weight-bold']); ?>

            <?php echo $form->field($model, 'category_id')->dropDownList($category, ['id' => 'categoriesTree', 'style' => 'width: 300px;'])->label('Select category', ['class' => 'font-weight-bold d-block mb-2']) ?>

        <!--<div class="form-group">
            <label class="font-weight-bold">Param1
                <input type="text" class="form-control mt-2" placeholder="Text param"></label>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Param2
                <input type="text" class="form-control mt-2" placeholder="Text param"></label>
        </div>-->
        <div class="form-group">
                <div class="d-flex mt-2">
                    <?php echo $form->field($model, 'price')->textInput(['class' => 'form-control mr-3', 'placeholder' => 'Enter price', 'id' => 'price']); ?>
                </div>
            <?php echo $form->field($model, 'country')->textInput(['class' => 'form-control w-50']);?>
            <label>
                <?php echo $form->field($model, 'is_negotiable')->checkbox(['class' => 'mr-2 ml-2', 'id' => 'price-negotiable'], true)?>
            </label>
        </div>
        <div class="form-group mt-2">

            <?php echo $form->field($model, 'imageFiles[]')->fileInput(['class' => 'form-control-file mt-2', 'id' => 'photo', 'multiple' => 'multiple', 'accept' => 'image/*'])->label('Add some photos', ['class' => 'font-weight-bold']) ?>

            <?php echo $form->field($model, 'city_id')->dropDownList($city, ['id' => 'city','style' => 'width: 150px;'])->label('Your city', ['class' => 'font-weight-bold d-block mb-2']);?>
        </div>
        <div class="text-center w-50 m0-auto">
            <?php echo Html::submitButton('Create', ['class' => 'btn btn-success btn-lg']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</section>
