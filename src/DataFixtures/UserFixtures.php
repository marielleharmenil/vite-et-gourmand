<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $client = new User();
        $client
            ->setEmail('berk@mail.com')
            ->setRoles(['ROLE_USER'])
            ->setFirstName('Prai')
            ->setLastName('Nomp')
            ->setPhone('0600000001')
            ->setAddress('1 rue de la rue')
            ->setPostalCode('33000')
            ->setCity('Bordeaux')
            ->setIsVerified(true);

        $client->setPassword(
            $this->passwordHasher->hashPassword($client, 'TestECF2026!')
        );

        $manager->persist($client);

        $employee = new User();
        $employee
            ->setEmail('employe@vite-gourmand.fr')
            ->setRoles(['ROLE_EMPLOYEE'])
            ->setFirstName('Employé')
            ->setLastName('Vite & Gourmand')
            ->setPhone('0600000002')
            ->setAddress('1 rue de la rue')
            ->setPostalCode('33000')
            ->setCity('Bordeaux')
            ->setIsVerified(true);

        $employee->setPassword(
            $this->passwordHasher->hashPassword($employee, 'Employe2026!')
        );

        $manager->persist($employee);

        $admin = new User();
        $admin
            ->setEmail('admin@vite-gourmand.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setFirstName('Admin')
            ->setLastName('Vite & Gourmand')
            ->setPhone('0600000003')
            ->setAddress('1 rue de la rue')
            ->setPostalCode('33000')
            ->setCity('Bordeaux')
            ->setIsVerified(true);

        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'Admin2026!')
        );

        $manager->persist($admin);

        $manager->flush();
    }
}