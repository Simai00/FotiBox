<?php

use fotiBox\Middleware\CORSMiddleware;
use fotiBox\Models\Camera;
use fotiBox\Models\Gallery;
use Slim\Http\Request;
use Slim\Http\Response;

$container = $app->getContainer();

$app->add(new CORSMiddleware($container['settings']['cors']));

$app->get('/', function (Request $request, Response $response): Response {
    return $response->write('Welcome to the FotiBox API');
});

$app->group('/v1', function () use ($container) {
    $this->group('/image', function () use ($container) {
        $this->get('/{id}/original', Gallery::class . ':getOriginalImage');
        $this->get('/{id}/preview', Gallery::class . ':getPreviewImage');
        $this->get('/{id}/medium', Gallery::class . ':getMediumImage');
    });
    $this->get('/images', Gallery::class . ':getImages');
    $this->group('/camera', function () use ($container) {
        $this->group('/capture', function () use ($container) {
            $this->get('/image', Camera::class . ':captureImage');
        });
    });
});
