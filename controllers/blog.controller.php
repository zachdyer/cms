<?php 

$this->respond('GET', '/?', function ($request, $response, $service, $app) {
    return 'Blog Page';
});

$this->respond('GET', '/archive/[:id]', function ($request, $response, $service, $app) {
    return 'Blog Archive ' . $request->id;
});