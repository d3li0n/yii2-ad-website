<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<div class="mb-5">

    <div class="mt-5 mb-3">
        <div class="container">
            <h2 class="h2 font-weight-bold"><span class="bg-secondary p-1 text-light">Marketplace LLC</span></h2>
            <hr>
            <div class="container">
            <div class="p-5 col-md-6">
                <p class="mt-4 h3">Whether you are buying new or used, plain or luxurious, trendy – if it exists in the world, it probably is for sale on Marketplace. Our mission is to be the world’s favorite destination for discovering great value and unique selection.</p>
            </div>
            <div class="p-5 col-md-6">
            <?php echo Html::img('https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/6035007/600/400/m2/fpnw/wm0/05-late-for-work-.jpg?1552245177&s=396ffb2a5930b030bfd366d983f8d4dc', ['class' => 'w-75 h-100 float-left']); ?>
            </div>
            </div>
        </div>
    </div>

    <div class="our-team">
        <div class="container">
            <h3 class="h3 text-center">Meet Our Team</h3>
            <div class="text-center">
                <div class="col-md-4 wow fadeInDown">
                    <?php echo Html::img('img/developer-dima.jpg', ['class' => 'rounded-circle w-50 h-50']); ?>
                    <h4 class="h4 font-weight-bold">Dima</h4>
                    <p><span class="h6 bg-warning p-1 rounded text-light">Developer</span></p>
                </div>

                <div class="col-md-4 wow fadeInDown">
                    <?php echo Html::img('img/developer-andrey.jpg', ['class' => 'rounded-circle w-50 h-50']); ?>
                    <h4 class="h4 font-weight-bold">Andrey</h4>
                    <p><span class="h6 bg-danger p-1 rounded text-light">Lead-Developer</span></p>
                </div>

                <div class="col-md-4 wow fadeInDown">
                    <?php echo Html::img('img/developer-ilya.jpg', ['class' => 'rounded-circle w-50 h-50']); ?>
                    <h4 class="h4 font-weight-bold">Ilya</h4>
                    <p><span class="h6 bg-warning p-1 rounded text-light">Developer</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
