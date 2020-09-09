<?php

use frontend\controllers\ProfileController;
use yii\helpers\Html;
use yii\widgets\ListView;

?>

<section class="container mt-5 mb-5">
    <ul class="nav nav-pills mb-3 m0-auto w-50 d-flex justify-content-center">
        <li class="nav-item">
            <?php echo HTML::a('My posts', 'my-posts', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Messages', 'messages', ['class' => 'nav-link font-weight-bold text-dark active'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Change Password', 'update-password', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
        <li class="nav-item">
            <?php echo HTML::a('Change Email', 'update-email', ['class' => 'nav-link font-weight-bold text-dark'])?>
        </li>
    </ul>

    <?php
        try {
            /** @var ProfileController $ad */
            echo ListView::widget([
                'dataProvider' => $model,
                'itemView' => '_message',
                'viewParams' => ['ad' => $ad],
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                    'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
                    'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
                    'maxButtonCount' => 5,
                ],
            ]);
        } catch (Exception $e) {
            echo $e;
            echo 'Messages are not found.';
        }
    ?>
</section>
