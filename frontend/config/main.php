<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            //'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                "" => "site/index",
                "about" => "site/about",
                "login" => "site/login",
                "logout" => "site/logout",
                "register" => "site/signup",
                "error" => "site/error",
                "terms" => "site/terms",
                "reset-password" => "site/request-password-reset",
                "resend-email" => "site/resend-verification-email",
                "contact" => "site/contact",
                "search" => "site/search-by-text",
                "settings" => "profile/view-settings",
                "my-posts" => "profile/posts",
                "messages" => "profile/messages",
                "update-password" => "profile/update-password",
                "update-email" => "profile/update-email",
                "conversation" => "chat/index",
                "ad" => "ad/view",
                "create-post" => "ad/create-post",
                "push" => "profile/update-ad"
            ],
        ],
    ],
    'params' => $params,
];
