<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Admin user
        $admin = new User();
        $admin->setEmail("admin@gmail.com");
        $admin->setRoles(["ROLE_ADMIN"]);
        $hashedPassword = $this->passwordHasher->hashPassword($admin, "admin123");
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        // Another admin user
        $admin2 = new User();
        $admin2->setEmail("iliass@gmail.com");
        $admin2->setRoles(["ROLE_USER"]);
        $hashedPassword = $this->passwordHasher->hashPassword($admin2, "iliass123");
        $admin2->setPassword($hashedPassword);
        $manager->persist($admin2);

        // Regular user
        $user = new User();
        $user->setEmail("mikaer@gmail.com");
        $user->setRoles(["ROLE_USER"]);
        $hashedPassword = $this->passwordHasher->hashPassword($user, "mika123");
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
