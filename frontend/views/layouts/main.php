<?php

/* @var $this View */
/* @var $content string */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="shadow p-3">
    <div class="d-flex justify-content-between align-items-center container">

        <?php echo Html::a(Html::img('img/logo.png', ['alt' => 'Market Logo']), '/', ['class' => 'main-logo']); ?>

        <?php /*$form = ActiveForm::begin(['id' => 'search-form']); */?><!--

            <?php /*echo $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control mr-sm-2', 'placeholder' => 'Search']); */?>
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">

            <?php /*echo Html::submitButton('Search', ['class' => 'btn btn-outline-success btn-rounded btn-sm my-0', 'name' => 'login-button']); */?>

            <button class="" type="submit">Search</button>
        --><?php /*ActiveForm::end();*/ ?>

        <nav class="main-nav form-inline">
            <?php
                if (Yii::$app->user->isGuest):

                    echo HTML::a('Log In', 'login', ['class' => 'btn btn-info main-nav-link mr-4']);

                    echo HTML::a('Sign Up', 'register', ['class' => 'btn btn-info main-nav-link mr-4']);

                else:

                    echo HTML::a('My Account', 'my-posts', ['class' => 'btn btn-info main-nav-link mr-4']);

                    echo Html::beginForm('logout', 'post');

                    echo Html::submitButton('Logout', [ 'class' => 'btn btn-info main-nav-link mr-4']);

                    echo Html::endForm();

                endif;

                    echo HTML::a('Create New Post', 'create-post', ['class' => 'btn btn-success btn-lg']);
            ?>
        </nav>
    </div>
</header>

<div class="wrap">
    <div class="container">
        <?php
            try {
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]);
            } catch (Exception $e) {
                echo 'Something went wrong.';
            }
        ?>
        <?= Alert::widget(); ?>
        <?= $content ?>
    </div>
</div>

<footer class="border-top pt-4 mt-5 main-footer">
    <div class="container d-flex justify-content-around">
        <?php
            $menuItems[] = '<li class="mb-1">' . HTML::a('Contact Us', 'contact', ['class' => 'text-dark bg-transparent']) . '</li>';
            $menuItems[] = '<li class="mb-1">' . HTML::a('Terms & Conditions', 'terms', ['class' => 'text-dark bg-transparent']) . '</li>';
            $menuItems[] = '<li class="mb-3">' . HTML::a('About', 'about', ['class' => 'text-dark bg-transparent']) . '</li>';

            try {
                echo Nav::widget([
                    'options' => ['class' => 'list-group w-25'],
                    'items' => $menuItems,
                ]);
            } catch (Exception $e) {
                echo 'Something went wrong.';
            }

            $socials[] = '<li class="mb-1">' . HTML::a('Facebook', '', ['class' => 'text-dark bg-transparent']) . '</li>';
            $socials[] = '<li class="mb-1">' . HTML::a('Twitter', '', ['class' => 'text-dark bg-transparent']) . '</li>';
            $socials[] = '<li class="mb-3">' . HTML::a('Instagram', '', ['class' => 'text-dark bg-transparent']) . '</li>';

            try {
                echo Nav::widget([
                    'options' => ['class' => 'list-group w-25'],
                    'items' => $socials,
                ]);
            } catch (Exception $e) {
                echo 'Something went wrong.';
            }
        ?>
    </div>
</footer>
<?php $this->endBody() ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
</body>
</html>

<?php $this->endPage() ?>
