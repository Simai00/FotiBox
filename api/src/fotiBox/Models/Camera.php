<?php

namespace fotiBox\Models;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Camera
{
    private $logger;
    private $imageService;
    protected $rootPath = __DIR__ . "/../../../";
    protected $imagePath = "images";
    protected $simulateCamera = false;
    protected $testImage = "images/test.jpg";

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
        $this->imageService = $container->get('imageService');
    }

    public function captureImage(Request $request, Response $response, $args): Response
    {
        $path = $this->rootPath . $this->imagePath . "/original/";
        $file = "DSC" . date("YmdHis") . ".jpg";
        if ($this->simulateCamera) {
            copy($this->rootPath . $this->testImage, $path . $file);
        } else {
            exec("gphoto2 --capture-image-and-download --filename " . $path . $file);
        }

        $imageId = $this->imageService->insertImageInDB($file);

        $this->imageService->generateImages($path, $file);

        return $response->withJson($this->imageService->getOneImage($imageId));
    }
}
