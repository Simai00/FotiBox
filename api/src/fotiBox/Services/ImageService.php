<?php

namespace fotiBox\Services;

use Psr\Container\ContainerInterface;

class ImageService
{

    private $db;
    private $logger;
    protected $rootPath = __DIR__ . "/../../../";
    protected $imagePath = "images/";

    public function __construct(ContainerInterface $container)
    {
        $this->db = $container->get('database');
        $this->logger = $container->get('logger');
    }

    public function getImageFileName(int $imageId, bool $getOriginalFileName = false)
    {
        $sql = <<< SQL
            SELECT path, bwFilter from image where id = :imageId
SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':imageId', $imageId);
        $stmt->execute();

        $result = $stmt->fetch();
        if ($result['bwFilter'] == 1 && !$getOriginalFileName) {
            $fileName = preg_replace("/\.jpg$/", "", $result['path']);
            return $fileName . "-BW.jpg";
        }
        return $result['path'];
    }

    public function getAllImages()
    {
        $sql = <<< SQL
            SELECT id, bwFilter, createdAt from image
SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function insertImageInDB(String $imagePath)
    {
        $sql = <<< SQL
            INSERT INTO image (path) VALUES (:path);

SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':path', $imagePath);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function getOneImage(String $imageId)
    {
        $sql = <<< SQL
            SELECT id, bwFilter, createdAt FROM image WHERE id= :id;

SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $imageId);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function isImageBW(String $imageId)
    {
        $sql = <<< SQL
            SELECT bwFilter FROM image WHERE id= :id;

SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $imageId);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result['bwFilter'] == 1;
    }

    public function getImage(String $id, String $quality)
    {
        $path = $this->rootPath . $this->imagePath;
        switch ($quality) {
            case "original":
                $path .= "original/";
                break;
            case "preview":
                $path .= "preview/";
                break;
            default:
                $path .= "medium/";
        }
        $path .= $this->getImageFileName($id);
        return file_get_contents($path);
    }

    public function generateImages(String $path, String $fileName)
    {
        $originalImage = imagecreatefromjpeg($path . $fileName);
        $originalWidth = imagesx($originalImage);
        $originalHeight = imagesy($originalImage);
        $mediumWidth = 1920;
        $mediumHeight = intval($originalHeight * $mediumWidth / $originalWidth);
        $mediumImage = imagecreatetruecolor($mediumWidth, $mediumHeight);
        imagecopyresized(
            $mediumImage,
            $originalImage,
            0, 0, 0, 0,
            $mediumWidth, $mediumHeight, $originalWidth, $originalHeight
        );
        $mediumImagePath = $this->rootPath . $this->imagePath . "medium/" . $fileName;
        imagejpeg($mediumImage, $mediumImagePath, 80);
        imagedestroy($originalImage);

        $previewWidth = 255;
        $previewHeight = intval($mediumHeight * $previewWidth / $mediumWidth);
        $previewImage = imagecreatetruecolor($previewWidth, $previewHeight);
        imagecopyresized(
            $previewImage,
            $mediumImage,
            0, 0, 0, 0,
            $previewWidth, $previewHeight, $mediumWidth, $mediumHeight
        );
        imagejpeg($previewImage, $this->rootPath . $this->imagePath . "preview/" . $fileName, 50);
        imagedestroy($mediumImage);
        imagedestroy($previewImage);
    }

    public function generateImagesWithFilter(String $imageId)
    {
        $imageFileName = $this->getImageFileName($imageId, true);
        $path = $this->rootPath . $this->imagePath;
        $this->generateImageWithFilter($path . "medium/", $imageFileName);
        $this->generateImageWithFilter($path . "original/", $imageFileName);
        $this->generateImageWithFilter($path . "preview/", $imageFileName);
        if (file_exists($path . "original/" . $imageFileName)) {
            $this->updateImageSetBW($imageId, true);
        }
    }

    public function removeImagesWithFilter(String $imageId)
    {
        $imageFileName = $this->getImageFileName($imageId);
        $path = $this->rootPath . $this->imagePath;
        unlink($path . "medium/" . $imageFileName);
        unlink($path . "original/" . $imageFileName);
        unlink($path . "preview/" . $imageFileName);
        if (!file_exists($path . "original/" . $imageFileName)) {
            $this->updateImageSetBW($imageId, false);
        }
    }

    private function generateImageWithFilter(String $path, String $fileName)
    {
        $image = imagecreatefromjpeg($path . $fileName);
        imagefilter($image, IMG_FILTER_GRAYSCALE);
        $newFileName = preg_replace("/\.jpg$/", "", $fileName);
        imagejpeg($image, $path . $newFileName . "-BW.jpg");
    }

    private function updateImageSetBW(String $imageId, bool $bwFilter)
    {
        $sql = <<< SQL
            UPDATE image set bwFilter = :bwFilter WHERE id= :id;

SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $imageId);
        if ($bwFilter) {
            $stmt->bindValue(':bwFilter', 1);
        } else {
            $stmt->bindValue(':bwFilter', 0);
        }
        $stmt->execute();
    }
}

