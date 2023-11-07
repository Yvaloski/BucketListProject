<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CAT1 = 'cat1';
    public const CAT2 = 'cat2';
    public const CAT3 = 'cat3';
    public const CAT4 = 'cat4';
    public const CAT5 = 'cat5';

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);




        $cat1 = new Category();
        $cat1->setName("Travel & Adventure");
        $manager->persist($cat1);

        $cat2 = new Category();
        $cat2->setName("Sport");
        $manager->persist($cat2);

        $cat3 = new Category();
        $cat3->setName("Entertainment");
        $manager->persist($cat3);

        $cat4 = new Category();
        $cat4->setName("Human Relations");
        $manager->persist($cat4);

        $cat5 = new Category();
        $cat5->setName("Others");
        $manager->persist($cat5);
        $manager->flush();

      $this->addReference(self::CAT1, $cat1);
      $this->addReference(self::CAT2, $cat2);
      $this->addReference(self::CAT3, $cat3);
      $this->addReference(self::CAT4, $cat5);
      $this->addReference(self::CAT5, $cat5);

    }
}
