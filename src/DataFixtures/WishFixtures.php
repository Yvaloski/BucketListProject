<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class WishFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);



        $wish = new Wish();
        $wish->setTitle("One wish ");
        $wish->setUser($this->getReference(UserFixtures::USER2));
        $wish->setDescription("some good description");
        $wish->setAuthor("John Doe");
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        $wish->setCategory($this->getReference(CategoryFixtures:: CAT3));
        $manager->persist($wish);

        $wish1 = new Wish();
        $wish1->setTitle("One Love ");
        $wish1->setUser($this->getReference(UserFixtures::USER2));
        $wish1->setDescription("some good love wishes");
        $wish1->setAuthor("John thatam");
        $wish1->setIsPublished(false);
        $wish1->setDateCreated(new \DateTime());
        $wish1->setCategory($this->getReference(CategoryFixtures::CAT2));

        $manager->persist($wish1);

        $wish2 = new Wish();
        $wish2->setTitle("be rich ");
        $wish2->setUser($this->getReference(UserFixtures::USER2));
        $wish2->setDescription("some good richness in a rich world");
        $wish2->setAuthor("John Doe");
        $wish2->setIsPublished(true);
        $wish2->setDateCreated(new \DateTime());
        $wish2->setCategory($this->getReference(CategoryFixtures::CAT1));

        $manager->persist($wish2);
        $manager->flush();

    }
}
