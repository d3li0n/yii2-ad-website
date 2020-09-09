<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model LoginForm */

use common\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<section class="container mt-5">

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

    <ul class="nav nav-pills mb-3 m0-auto w-50 d-flex justify-content-center">
        <li class="nav-item">
            <?php echo HTML::a('Login', 'login', ['class' => 'nav-link font-weight-bold text-dark active']); ?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Sign Up', 'register', ['class' => 'nav-link font-weight-bold text-dark']); ?>
        </li>
    </ul>

    <div class="tab-content m0-auto w-50" id="pills-tabContent">
        <div class="tab-pane show active" id="pills-login" role="tabpanel" aria-labelledby="pills-home-tab">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="form-group">
                    <?php echo $form->field($model, 'username')->textInput(['autofocus' => true]); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->field($model, 'password')->passwordInput(); ?>
                </div>
                <div class="form-group text-center">
                    <?php echo $form->field($model, 'rememberMe')->checkbox(); ?>
                </div>
                <div class="w-50 m0-auto text-center">
                    <?php echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
                </div>

            <div style="color:#999; margin:1em 0;" class="text-center">
                If you forgot your password you can <?php echo Html::a('reset it', ['site/request-password-reset'], ['style' => 'color: red']); ?>.
                <br>
                Need new verification email? <?php echo Html::a('Resend', ['site/resend-verification-email'], ['style' => 'color: red']); ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
