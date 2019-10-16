<?php


namespace fotiBox\Services;

use Psr\Container\ContainerInterface;
use Tinify\AccountException;
use Tinify\ClientException;
use Tinify\ConnectionException;
use Tinify\ServerException;
use function Tinify\fromFile;

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
        $path .= $this->getImagePath($id);
        return file_get_contents($path);
    }

    public function generateImages(String $path, String $fileName)
    {
        try {
            $original = fromFile($path . $fileName);
            $preview = $original->resize(array(
                "method" => "cover",
                "width" => 150,
                "height" => 150
            ));
            $preview->toFile($this->rootPath . $this->imagePath . "preview/" . $fileName);

            $medium = $original->resize(array(
                "method" => "scale",
                "width" => 1080
            ));
            $medium->toFile($this->rootPath . $this->imagePath . "medium/" . $fileName);
        } catch (AccountException $e) {
            $this->logger->error("The error message is: " . $e->getMessage());
            // Verify your API key and account limit.
        } catch (ClientException $e) {
            $this->logger->error("Source image and request options");
            // Check your source image and request options.
        } catch (ServerException $e) {
            $this->logger->error("Temp issue with Tinify API");
            // Temporary issue with the Tinify API.
        } catch (ConnectionException $e) {
            $this->logger->error("Network error");
            // A network connection error occurred.
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            // Something else went wrong, unrelated to the Tinify API.
        }
    }
}

