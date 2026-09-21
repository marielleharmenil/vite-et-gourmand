<?php

namespace App\DataFixtures;

use App\Entity\Dish;
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

        $entree = new Dish();
        $entree->setName('Velouté de saison');
        $entree->setType('Entrée');
        $entree->setDescription('Velouté préparé avec des légumes de saison.');
        $entree->addMenu($menu);

        $manager->persist($entree);

        $plat = new Dish();
        $plat->setName('Suprême de volaille');
        $plat->setType('Plat');
        $plat->setDescription('Suprême de volaille accompagné de légumes.');
        $plat->addMenu($menu);

        $manager->persist($plat);

        $dessert = new Dish();
        $dessert->setName('Fondant au chocolat');
        $dessert->setType('Dessert');
        $dessert->setDescription('Fondant au chocolat servi en dessert.');
        $dessert->addMenu($menu);

        $manager->persist($dessert);

        $manager->flush();
    }
}