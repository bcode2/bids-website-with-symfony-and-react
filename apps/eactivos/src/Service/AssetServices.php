<?php

namespace App\Services;

use App\Entity\Asset;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class AssetServices extends BasicServices

{
    private $repository;
    protected $em;
    private $container;

    public function __construct(Container $container, EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
        $this->repository = $this->em->getRepository('App:Asset');
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function findByCategory($name)
    {
        return $this->repository->findByCategory($name);
    }

    public function createAsset(Asset $asset): int
    {
        $this->em->persist($asset);
        $this->flushObjects();

        return $asset->getId();
    }

    public function deleteAsset(int $id): int
    {
        $asset = $this->getById($id);
        if (!$asset) {
            return ("No existe la subasta especificada");
        }
        $this->em->remove($id);
        $this->flushObjects();

        return ("Subasta Borrada");
    }

    public function getById(int $id)
    {
        return $this->repository->find($id);
    }

    public function updateAsset(Asset $asset): bool
    {
        try {
            $this->flushObjects();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
