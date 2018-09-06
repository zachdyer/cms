<?php // Routes

// Initialize Klein and use pug as default render engine
$klein = new \Klein\Klein();
$klein->app()->pug = new \Pug\Pug();

//Routes
$klein->with('/', CONTROLLERS . "/home.controller.php");
$klein->with('/blog', CONTROLLERS . "/blog.controller.php");

// Initialize routes
$klein->dispatch();