<?php
    $routes['home']    = 'user/index';
    $routes['about']   = 'user/about';
    $routes['profil']  = 'user/profil';
    $routes['profile'] = 'dashboard/profil';
    $routes['logout']  = 'auth/logout';
    $routes['login']   = 'auth/show_login';
    $routes['admin/login'] = 'auth/show_login_admin';
    $routes['auth/login_admin'] = 'auth/login_admin';
    $routes['daftar']  = 'auth/show_daftar';
    $routes['search']  = 'user/search';
    $routes['trending'] = 'user/trending';

    DEFINE('ROUTER',$routes);
?>