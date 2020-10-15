<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends BaseFixture
{
    private static $categoryindex = 1;

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(
            Category::class,
            8,
            function (Category $category, $count) {
                $category->setName($this->selectCategory());
            }
        );
        $manager->flush();
    }

    public function selectCategory()
    {
        $categoryName;

        switch (self::$categoryindex) {

            case 1:
            {
                self::$categoryindex++;

                return ("Coches");
            }
            case 2:
            {
                self::$categoryindex++;

                return ("Garajes");

            }
            case 3:
            {
                self::$categoryindex++;

                return ("Herramientas");

            }
            case 4:
            {
                self::$categoryindex++;

                return ("Locales");

            }
            case 5:
            {
                self::$categoryindex++;

                return ("Terrenos");

            }
            case 6:
            {
                self::$categoryindex++;

                return ("Viviendas");

            }
        }
    }
}
