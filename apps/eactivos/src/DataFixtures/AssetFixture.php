<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use Doctrine\Persistence\ObjectManager;


class AssetFixture extends BaseFixture
{

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(
            Asset::class,
            30,
            function (Asset $asset, $count) {
                $asset->setName($this->faker->company);
                $asset->setPrice($this->faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 100));
                $asset->setDescription($this->faker->text($maxNbChars = 160));
                $asset->setEndDate($this->faker->dateTimeBetween('+1 week', '+2 month'));
            }
        );
        $manager->flush();
    }
}
