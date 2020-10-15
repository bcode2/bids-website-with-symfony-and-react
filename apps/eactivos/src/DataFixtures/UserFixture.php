<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class UserFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $user = new User();
        $user->setName("admin");
        $user->setSurname("admin");
        $user->setEmail("bcode@protonmail.com");
        $user->setPassword(password_hash("password", PASSWORD_DEFAULT));
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setIsadmin(true);

        $manager->persist($user);

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setName($this->faker->firstNameMale);
            $user->setSurname($this->faker->lastName);
            $user->setEmail($this->faker->email);
            $user->setPassword(password_hash($this->faker->password, PASSWORD_DEFAULT));
            $user->setIsadmin(false);
            $manager->persist($user);
            $user->setRoles(['ROLE_USER']);
        }
        $manager->flush();
    }
}
