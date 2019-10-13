<?php


namespace fotiBox\Services;

use Psr\Container\ContainerInterface;
use PDO;

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

    public function insertImageInDB()
    {
        $sql = <<< SQL
#             INSERT INTO image (path, createdAt, )
# values in db unknown
SQL;

    }
}

