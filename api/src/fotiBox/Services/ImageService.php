<?php


namespace fotiBox\Services;

use Psr\Container\ContainerInterface;

class ImageService
{

    private $db;
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->db = $container->get('database');
        $this->logger = $container->get('logger');
    }

    public function getImagePath(int $imageId): String
    {
        $sql = <<< SQL
            SELECT path from image where id = :imageId
SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':imageId', $imageId);
        $stmt->execute();

        $bla = $stmt->fetch();
        return $bla['path'];
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

    public function getImage(String $imageId)
    {
        $sql = <<< SQL
            SELECT id, createdAt FROM image WHERE id= :id;

SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $imageId);
        $stmt->execute();

        return $stmt->fetch();
    }
}

