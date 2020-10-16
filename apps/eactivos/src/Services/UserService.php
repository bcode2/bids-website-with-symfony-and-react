<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class UserService extends AbstractEntityService

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
     * @return User|object|null
     */
    public function findOneById(int $id): User
    {
        dump($this->getRepository()->find($id));

        return $this->getRepository()->find($id);
    }

    /**
     * @return UserRepository|ObjectRepository
     */
    public function getRepository(): ObjectRepository
    {
        return $this->getEntityManager()->getRepository(User::class);
    }

    public function create(User $user): int
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user->getId();
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
     * @param string $email
     *
     * @return User|object|null
     */
    public function findOneByEmail(string $email)
    {
        return $this->getRepository()->findOneBy(['email' => $email,]);
    }
}
