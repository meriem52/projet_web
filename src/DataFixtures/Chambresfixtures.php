<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Chambres;


class Chambresfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Tableau de données pour les chambres
        $chambresData = [
            [
                'numero' => 1,
                'type' => 'Type de chambre 1',
                'prix' => 100,
                'capacite' => 2,
                'description' => 'Découvrez notre chambre double spacieuse avec vue imprenable',
                'image' => 'assetsHome/imd/room-b4.jpg',
                'statut' => true,
            ],
            [
                'numero' => 2,
                'type' => 'single',
                'prix' => 120,
                'capacite' => 3,
                'description' => 'Vivez une expérience de séjour exceptionnelle dans notre suite exécutive offrant une vue panoramique à couper le souffle',
                'image' => 'assetsHome/imd/room-6.jpg',
                'statut' => true,
            ],
            [
                'numero' => 12,
                'type' => 'single',
                'prix' => 420,
                'capacite' => 1,
                'description' => 'Découvrez notre chambre single pratique, idéale pour les voyageurs en solo. Compacte et fonctionnelle, elle offre tout le confort nécessaire pour un séjour agréable.',
                'image' => 'assetsHome/imd/room-5.jpg',
                'statut' => true,
            ],
            [
                'numero' => 52,
                'type' => 'single',
                'prix' => 420,
                'capacite' => 1,
                'description' => 'Découvrez notre chambre single pratique, idéale pour les voyageurs en solo. Compacte et fonctionnelle, elle offre tout le confort nécessaire pour un séjour agréable.',
                'image' => 'assetsHome/imd/room-5.jpg',
                'statut' => true,
            ],[
                'numero' => 128,
                'type' => 'double',
                'prix' => 220,
                'capacite' => 1,
                'description' => 'Découvrez notre chambre double pratique. Compacte et fonctionnelle, elle offre tout le confort nécessaire pour un séjour agréable.',
                'image' => 'assetsHome/imd/room-b4.jpg',
                'statut' => true,
            ],[
                'numero' => 170,
                'type' => 'single',
                'prix' => 420,
                'capacite' => 1,
                'description' => 'Découvrez notre chambre single pratique, idéale pour les voyageurs en solo. Compacte et fonctionnelle, elle offre tout le confort nécessaire pour un séjour agréable.',
                'image' => 'assetsHome/imd/room-5.jpg',
                'statut' => true,
            ],
            [
                'numero' => 140,
                'type' => 'double',
                'prix' => 170,
                'capacite' => 2,
                'description' => 'Vivez une expérience de séjour exceptionnelle dans notre suite exécutive ',
                'image' => 'assetsHome/imd/room-details.jpg',
                'statut' => false,
            ]
        ];

        // Boucle à travers les données des chambres et les sauvegarder dans la base de données
        foreach ($chambresData as $chambreData) {
            $chambre = new Chambres();
            $chambre->setNumero($chambreData['numero']);
            $chambre->setType($chambreData['type']);
            $chambre->setPrix($chambreData['prix']);
            $chambre->setCapacite($chambreData['capacite']);
            $chambre->setDescription($chambreData['description']);
            $chambre->setImage($chambreData['image']);
            $chambre->setStatut($chambreData['statut']);

            $manager->persist($chambre);
        }

        // Enregistrer les chambres dans la base de données
        $manager->flush();
    }
}


