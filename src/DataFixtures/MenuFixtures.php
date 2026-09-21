<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MenuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $menu = new Menu();

        $menu->setTitle('Menu Élégance');
        $menu->setDescription('Un menu complet pour vos événements et réceptions.');
        $menu->setTheme('Classique');
        $menu->setRegime('Classique');
        $menu->setMinPeople(4);
        $menu->setPrice('120.00');
        $menu->setStock(5);
        $menu->setConditions(
            'Commande à réserver au minimum 48 heures avant la prestation.'
        );

        $manager->persist($menu);
        $manager->flush();
    }
}