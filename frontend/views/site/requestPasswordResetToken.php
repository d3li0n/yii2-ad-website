<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model PasswordResetRequestForm */

use frontend\models\PasswordResetRequestForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<section class="container ">
    <div class="text-center mt-5 mb-3">
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

        <h2 class="h2">Reset Your Password</h2>
    </div>
    <p class="text-center mb-3">Please fill out your email. A link to reset password will be sent there.</p>

    <div class="row">
        <div class="col-lg-5 center-block">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?php echo $form->field($model, 'email')->textInput(['autofocus' => true]); ?>

                <div class="form-group">
                    <?php echo Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
