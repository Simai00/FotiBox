<?php

namespace fotiBox\Models;

use Psr\Container\ContainerInterface;

class Camera
{
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
    }

    public function captureImage() {
        $path = __DIR__ . "../../image/";
        $cmd = "gphoto2 --capture-image-and-download --filename ${$path}DSC%H%M%S.%C";
        exec($cmd);
    }
}
