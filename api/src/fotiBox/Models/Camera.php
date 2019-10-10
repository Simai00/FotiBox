<?php

namespace fotiBox\Models;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Camera
{
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
    }

    public function captureImage(Request $request, Response $response, $args): Response {
        $path = __DIR__ . "/../../image/";
        $cmd = "gphoto2 --capture-image-and-download --filename DSC%H%M%S.%C";
        exec($cmd, $out);
        return $response->write($out);
    }
}
