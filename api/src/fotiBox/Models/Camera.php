<?php

namespace fotiBox\Models;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Camera
{
    private $logger;
    private $imageService;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
        $this->imageService = $container->get('imageService');
    }

    public function captureImage(Request $request, Response $response, $args): Response {
        $path = __DIR__ . "/../../image/"; // TODO: Add date folder
        exec("gphoto2 --capture-image-and-download --filename " . $path . "DSC%H%M%S.%C"); // DSCStundeMinuteSekundeMillisekunde.%C
        // TODO: Insert Image into DB (create function in ImageService.php)
        $this->imageService->insertImageInDB($path);
        $id = $this->imageService->getImageByPath($path);
        return $response->write("Image Captured"); // TODO: return as defined in /api/README.md
        //return image id fehlt
    }
}
