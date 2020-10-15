<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use App\Entity\Bid;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class BidFixture extends BaseFixture implements DependentFixtureInterface
{

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(
            Bid::class,
            14,
            function (Bid $bid, $count) {
                $bid->setUser();
                $bid->setPrice($this->faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 100));
                $bid->setAsset($this->getRandomReference(Asset::class));
            }
        );
        $manager->flush();
    }

    public function getDependencies()
    {
        return [AssetFixture::class];
    }
}
