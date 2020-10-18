<?php

namespace App\Services;

use App\Entity\Asset;
use App\Repository\AssetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class AssetService extends AbstractEntityService

{
    private $repository;
    protected $em;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($entityManager);
    }

    public function getAll(): array
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param $id
     *
     * @return Asset|object|null
     */
    public function findOneById(int $id): Asset
    {
        dump($this->getRepository()->find($id));

        return $this->getRepository()->find($id);
    }


    public function create(Asset $asset): int
    {
        $this->getEntityManager()->persist($asset);
        $this->getEntityManager()->flush();

        return $asset->getId();
    }

    /**
     * @param Asset $entity
     *
     * @return Asset
     */
    public function delete(Asset $entity): Asset
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    public function getById(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @return AssetRepository|ObjectRepository
     */
    public function getRepository(): ObjectRepository
    {
        return $this->getEntityManager()->getRepository(Asset::class);
    }
}
