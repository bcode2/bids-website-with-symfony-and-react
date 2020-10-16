<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $user = new User();
        $user->setName("Carlos");
        $user->setSurname("Garcia");
        $user->setEmail("bcode@protonmail.com");
        $user->setPassword('password');
        $user->setIsAdmin(true);

        $manager->persist($user);

        $this->createMany(
            User::class,
            20,
            function (User $user, $count) {
                $user->setName($this->faker->firstNameMale);
                $user->setSurname($this->faker->lastName);
                $user->setEmail($this->faker->email);
                $user->setPassword($this->faker->password);
                $user->setIsadmin(false);
            }
        );
        /*for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setName($this->faker->firstNameMale);
            $user->setSurname($this->faker->lastName);
            $user->setEmail($this->faker->email);
            $user->setPassword($this->faker->password);
            $user->setIsadmin(false);
            $manager->persist($user);
        }*/
        $manager->flush();
    }
}
