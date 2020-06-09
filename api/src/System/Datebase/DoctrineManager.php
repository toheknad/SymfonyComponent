<?php

namespace App\System\Datebase;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DoctrineManager
{
    private $params;
    private $entityManager;

    public function __construct($params = [
        "dbname" =>"doctrine",
        "user" => "root",
        "password" => "example",
        "host" => "db",
        "driver" =>"pdo_mysql"]
    )
    {
        $this->params = $params;
        $entityManager = null;
        $config = Setup::createAnnotationMetadataConfiguration(array("src/Entities"), true);

        $entityManager = EntityManager::create($this->params, $config);
        $this->setEntityManager($entityManager);
    }

    private function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager(){
        return $this->entityManager;
    }


}