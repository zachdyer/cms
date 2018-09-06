<?php


$this->respond('GET', '/?', function ($request, $response, $service, $app) {
  return $app->pug->render(VIEWS . "/home.pug", array(
    'company'         => getSettings()->company,
    'email'  => isset($_SESSION['email']) ? $_SESSION['email'] : false,
    'selected' => 'home',
    'theme'=> getSettings()->theme,
    'year'=> date('Y'),
    'experience' => date('Y') - 2008
  ));
});