<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use App\Entity\Bid;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BidFixture extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(
            Bid::class,
            60,
            function (Bid $bid, $count) {
                $bid->setUser($this->getRandomReference(User::class));
                $bid->setBidAmount($this->faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 100));
                $bid->setAsset($this->getRandomReference(Asset::class));
                $bid->setEffectDate();
            }
        );
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [AssetFixture::class, UserFixture::class];
    }
}
