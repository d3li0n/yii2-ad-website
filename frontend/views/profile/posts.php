<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>

<section class="container mt-5 mb-5">
    <ul class="nav nav-pills mb-3 m0-auto w-50 d-flex justify-content-center">
        <li class="nav-item">
            <?php echo HTML::a('My posts', 'my-posts', ['class' => 'nav-link active font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Messages', 'messages', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Change Password', 'update-password', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Change Email', 'update-email', ['class' => 'nav-link font-weight-bold text-dark'])?>
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

    <?php
        try {
            echo ListView::widget([
                'dataProvider' => $model,
                'itemView' => '_post',
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                    'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
                    'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
                    'maxButtonCount' => 5,
                ],
            ]);
        } catch (Exception $e) {
            echo 'Posts are not found';
        }
    ?>
</section>