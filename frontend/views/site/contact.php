<?php

/* @var $this yii\web\View */
/* @var $form ActiveForm */
/* @var $model ContactForm */

use frontend\models\ContactForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
<div class="site-contact">
    <div class="row">
        <div class="col-lg-5 center-block mt-2">

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

            <h2 class="mt-5 font-weight-bold h2 text-center">Contact Form</h2>
            <p class="mb-3 text-center">
                If you would prefer to discuss in person or over the phone, please include the necessary details in your message and we will get back to you as soon as possible.
            </p>

            <?php

                $form = ActiveForm::begin(['id' => 'contact-form']);

                echo $form->field($model, 'email')->textInput();

                echo $form->field($model, 'mobile')->textInput(['type' => 'number']);

                echo $form->field($model, 'body')->textarea(['rows' => 6]);

                echo $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])
            ?>

            <div class="form-group">
                <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
