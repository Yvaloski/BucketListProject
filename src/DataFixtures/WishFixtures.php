<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WishFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $wish = new Wish();
        $wish->setTitle("One wish ");
        $wish->setDescription("some good description");
        $wish->setAuthor("John Doe");
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        $manager->persist($wish);

        $wish1 = new Wish();
        $wish1->setTitle("One Love ");
        $wish1->setDescription("some good love wishes");
        $wish1->setAuthor("John thatam");
        $wish1->setIsPublished(false);
        $wish1->setDateCreated(new \DateTime());
        $manager->persist($wish1);

        $wish2 = new Wish();
        $wish2->setTitle("be rich ");
        $wish2->setDescription("some good richness in a rich world");
        $wish2->setAuthor("John Doe");
        $wish2->setIsPublished(true);
        $wish2->setDateCreated(new \DateTime());
        $manager->persist($wish2);
        $manager->flush();
    }
}