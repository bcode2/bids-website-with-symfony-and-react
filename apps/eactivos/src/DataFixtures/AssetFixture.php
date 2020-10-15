<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use App\Entity\Category;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class AssetFixture extends BaseFixture implements DependentFixtureInterface
{
    private static $imagePrefix = 1;

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(
            Asset::class,
            14,
            function (Asset $asset, $count) {

                $asset->setName("Asset blabla".$this->faker->domainWord);
                $asset->setPrice($this->faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 100));
                $asset->setImg("gafa".self::$imagePrefix++.".jpg");
                $asset->setCategory($this->getRandomReference(Category::class));
            }
        );
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixture::class];
    }
}
