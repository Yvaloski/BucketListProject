<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;
    public const USER1 = 'user1';
    public const USER2 = 'user2';
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user1 = new User();
        $user1->setEmail('admin@series.com');
        $user1->setPassword($this->hasher->hashPassword($user1,'1234'));
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setUsername('admin');

        $manager->persist($user1);

        $user2 = new User;
        $user2->setEmail('john@gmail.com');
        $user2->setPassword($this->hasher->hashPassword($user2,'1234'));
        $user2->setUsername('John');
        $manager->persist($user2);
        $manager->flush();

        $this->addReference(self::USER1, $user1);
        $this->addReference(self::USER2, $user2);
    }
}
