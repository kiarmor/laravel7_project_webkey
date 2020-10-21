<?php


if(!defined('ROOT')) define('ROOT', dirname(__DIR__));
if(!defined('WWW')) define('WWW', ROOT . '/public');
if(!defined('APP')) define('APP', ROOT . '/app');
if(!defined('CORE')) define('CORE', ROOT . '/resources');
if(!defined('LIBS')) define('LIBS', ROOT . '/resources/libs');
if(!defined('CACHE')) define('CACHE', ROOT . '/tmp/cache');
if(!defined('CONF')) define('CONF', ROOT . '/config');
if(!defined('LAYOUT')) define('LAYOUT', 'app.blade.php');
if(!defined('GALLERY')) define('GALLERY', '/public/uploads/gallery');
if(!defined('IMG')) define('IMG', '/public/uploads/single');

$host = false;

if (isset($_SERVER['HTTP_HOST'])){
    $host = $_SERVER['HTTP_HOST'];
}

$allowed_hosts = 'http://localhost:8000/index.php';

if (!defined('PATH')) define('PATH', env('APP_URL'));
if (!defined('ADMIN')) define('ADMIN', PATH . '/admin/index');

/*ROOT =
WWW = ROOT . /public
APP = ROOT . /app
CORE = ROOT . /resources
LIBS = ROOT . /resources/libs
CACHE = ROOT . /tmp/cache
CONF = ROOT . /config
LAYOUT = app.blade.php
GALLERY = /public/uploads/gallery
IMG = /public/uploads/single*/