<?php

use fotiBox\Middleware\CORSMiddleware;
use fotiBox\Models\Gallery;

$container = $app->getContainer();

$app->add(new CORSMiddleware($container['settings']['cors']));

$app->group('/v1', function () use ($container) {
    $this->group('/image', function () use ($container) {
        $this->get('/test', Gallery::class . ':getTestImage');
        $this->get('/{id}', Gallery::class . ':getImage');
    });
    $this->get('/images', Gallery::class . ':getImages');
});
