<?php


namespace fotiBox\Services;

use Psr\Container\ContainerInterface;

class ImageService
{

    private $db;
    private $logger;
    protected $imagePath = "images/";

    public function __construct(ContainerInterface $container)
    {
        $this->db = $container->get('database');
        $this->logger = $container->get('logger');
    }

    public function getImagePath(int $imageId)
    {
        $sql = <<< SQL
            SELECT path from image where id = :imageId
SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':imageId', $imageId);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result['path'];
    }

    public function getAllImages()
    {
        $sql = <<< SQL
            SELECT id, createdAt from image
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
            SELECT id, createdAt FROM image WHERE id= :id;

SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $imageId);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getImage(String $id, String $quality)
    {
        $path = __DIR__ . "/../../../" . $this->imagePath;
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
        $path .= $this->getImagePath($id);
        return file_get_contents($path);
    }
}

