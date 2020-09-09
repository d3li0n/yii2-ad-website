<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<container class="site-error">
    <div class="text-center">
        <h1 class="h1 mt-5 mb-5"><?php echo Html::encode($this->title); ?></h1>

        <div class="alert alert-danger m-auto w-50">
            <?php echo nl2br(Html::encode($message)); ?>
        </div>

        <p class="mt-5">
            The above error occurred while the Web server was processing your request.<br>
            Please contact us if you think this is a server error. Thank you.
        </p>
    </div>
</container>
