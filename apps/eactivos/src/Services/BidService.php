<?php

namespace App\Services;

use App\Entity\Bid;
use App\Repository\BidRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class BidService extends AbstractEntityService

{
    protected $em;
    private $repository;

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
        return $this->repository->findAll();
    }

    /**
     * @param $id
     *
     * @return Bid|object|null
     */
    public function findOneById(int $id): Bid
    {

        return $this->getRepository()->find($id);
    }

    /**
     * @return BidRepository|ObjectRepository
     */
    public function getRepository(): ObjectRepository
    {
        return $this->getEntityManager()->getRepository(Bid::class);
    }

    public function create(Bid $bid): int
    {
        $this->getEntityManager()->persist($bid);
        $this->getEntityManager()->flush();

        return $bid->getId();
    }

    /**
     * @param Bid $entity
     *
     * @return Bid
     */
    public function delete(Bid $entity): Bid
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
}
