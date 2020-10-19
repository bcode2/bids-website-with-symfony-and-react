<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{

    /**
     * @param string $email
     *
     * @return User|object|null
     */
    public function findOneByEmail(string $email)
    {
        $em = $this->getEntityManager();

        return $em->getRepository(User::class)->findOneBy(['email' => $email]);
    }
}
