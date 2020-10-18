<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $user = new User();
        $user->setName("Admin");
        $user->setSurname("User");
        $user->setEmail("admin@eactivos.com");
        $user->setPassword('password');
        $user->setIsAdmin(true);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $password = $this->encoder->encodePassword($user, '12345');
        $user->setPassword($password);
        $manager->persist($user);

        $user = new User();
        $user->setName("Normal");
        $user->setSurname("User");
        $user->setEmail("user@eactivos.com");
        $user->setPassword('12345');
        $user->setIsAdmin(true);
        $user->setRoles(['ROLE_USER', 'ROLE_BUYER']);
        $password = $this->encoder->encodePassword($user, '12345');
        $user->setPassword($password);
        $manager->persist($user);

        $this->createMany(
            User::class,
            10,
            function (User $user, $count) {
                $user->setName($this->faker->firstNameMale);
                $user->setSurname($this->faker->lastName);
                $user->setEmail($this->faker->email);
                $user->setIsadmin();
                $user->setRoles(['ROLE_USER', 'ROLE_BUYER']);
                $password = $this->encoder->encodePassword($user, '12345');
                $user->setPassword($password);
            }
        );
        $manager->flush();
    }
}
