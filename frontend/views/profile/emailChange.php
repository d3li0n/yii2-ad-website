<?php

use frontend\controllers\ProfileController;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<section class="container mt-5 mb-5">
    <ul class="nav nav-pills mb-3 m0-auto w-50 d-flex justify-content-center">
        <li class="nav-item">
            <?php echo HTML::a('My posts', 'my-posts', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Messages', 'messages', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Change Password', 'update-password', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Change Email', 'update-email', ['class' => 'nav-link active font-weight-bold text-dark'])?>
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

    <div class="tab-pane" id="pills-settings" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="form-group w-50 center-block">

            <?php
                $form = ActiveForm::begin([
                    'id' => 'emailchange-form',
                    'options' => ['class' => 'form-horizontal'],
                    'method' => 'post',
                ]);

                /** @var ProfileController $email */
                echo $form->field($email,'email',[
                    'inputOptions'=>[
                        'placeholder'=>'Enter New Email', [
                            'class' => 'form-control mt-2',
                        ]
                    ]
                ]);

                echo $form->field($email,'password',[
                        'inputOptions'=>[
                            'placeholder'=>'Password', [
                                'class' => 'form-control mt-2'
                            ]
                        ]
                ])->passwordInput();
            ?>

            <div class="w-20 m0-auto text-center">
                <?php
                    echo Html::submitButton('Submit',[
                        'class'=>'btn btn-info',
                    ]);
                ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>