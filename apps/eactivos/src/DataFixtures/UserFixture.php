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
        $user->setName("Carlos");
        $user->setSurname("Garcia");
        $user->setEmail("bcode@protonmail.com");
        $user->setPassword('password');
        $user->setIsAdmin(true);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $password = $this->encoder->encodePassword($user, '12345');
        $user->setPassword($password);

        $manager->persist($user);

        $this->createMany(
            User::class,
            20,
            function (User $user, $count) {
                $user->setName($this->faker->firstNameMale);
                $user->setSurname($this->faker->lastName);
                $user->setEmail($this->faker->email);
                $user->setIsadmin();
                $user->setRoles(['ROLE_USER']);
                $password = $this->encoder->encodePassword($user, '12345');
                $user->setPassword($password);
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
