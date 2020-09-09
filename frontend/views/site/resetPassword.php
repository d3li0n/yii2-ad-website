<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model ResetPasswordForm */

use frontend\models\ResetPasswordForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-reset-password">

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?php echo $form->field($model, 'password')->passwordInput(['autofocus' => true]); ?>

                <div class="form-group">
                    <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']); ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
