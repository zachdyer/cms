<?php

// Define root path
define("ROOTPATH", "/var/www/zachdyer.com");

// Start program
require(ROOTPATH . "/private/init.php");

$klein = new \Klein\Klein();
$klein->app()->pug = new \Pug\Pug();

$klein->with('/', "controllers/home.controller.php");
$klein->with('/blog', "controllers/blog.controller.php");

$klein->dispatch();
