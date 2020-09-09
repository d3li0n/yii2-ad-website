<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<container class="site-resend-verification-email">
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

        <h2 class="h2">Resend Your Verification Email</h2>
    </div>

    <p class="text-center mb-3">Please fill out your email. A verification email will be sent there.</p>

    <div class="row">
        <div class="col-lg-5 center-block">
            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <?php echo $form->field($model, 'email')->textInput(['autofocus' => true]); ?>

            <div class="form-group">
                <?php echo Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</container>
