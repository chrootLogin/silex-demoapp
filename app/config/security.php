<?php

$app['security.firewalls'] = array(
    /* // Ensure that the login page is accessible to all, if you set anonymous => false below.
    'login' => array(
        'pattern' => '^/user/login$',
    ), */
    'secured_area' => array(
        'pattern' => '^.*$',
        'anonymous' => true,
        'remember_me' => array(),
        'form' => array(
            'login_path' => '/user/login',
            'check_path' => '/user/login_check',
        ),
        'logout' => array(
            'logout_path' => '/user/logout',
        ),
        'users' => $app->share(function($app) { return $app['user.manager']; }),
    ),
);