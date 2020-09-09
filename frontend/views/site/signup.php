<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model SignupForm */

use frontend\models\SignupForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<section class="container mt-5">
    <ul class="nav nav-pills mb-3 m0-auto w-50 d-flex justify-content-center">
        <li class="nav-item">
            <?php echo HTML::a('Login', 'login', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Sign Up', 'register', ['class' => 'nav-link font-weight-bold text-dark active'])?>
        </li>
    </ul>

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

    <div class="tab-content m0-auto w-50" id="pills-tabContent">
        <div class="tab-pane show active" id="pills-register" role="tabpanel" aria-labelledby="pills-contact-tab">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="form-group mb-1">
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo $form->field($model, 'firstName')->textInput(['autofocus' => true, 'placeholder' => 'First Name']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $form->field($model, 'lastName')->textInput(['autofocus' => true, 'placeholder' => 'Second Name']); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']); ?>
            </div>

            <div class="form-group">
                <?php echo $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email address']); ?>
            </div>

            <div class="form-group">
                <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']); ?>
            </div>

            <div class="form-group">
                <?php echo $form->field($model, 'confirmPassword')->passwordInput(['placeholder' => 'Confirm Password']); ?>
            </div>

            <?php echo Html::submitButton('Signup', ['class' => 'btn btn-info', 'name' => 'signup-button']); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>