<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Services;


class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $servicesData = [
            [
                'nom' => 'Catering',
                'description' => 'Enjoy a complete catering service to enhance your stay. Our talented chefs prepare delicious and diverse dishes, catering to all tastes and dietary needs. Experience exceptional culinary delights without leaving the comfort of your room or our dining areas.',
                'prix' => 20.0,
            ],
            [
                'nom' => 'Babysitting',
                'description' => 'Our professional babysitting service allows parents to relax and enjoy their free time knowing their children are in good hands. Experienced caregivers provide attentive care, ensuring a worry-free stay for parents.',
                'prix' => 15.0,
            ],
            [
                'nom' => 'Laundry',
                'description' => ' Simplify your stay with our professional laundry service. We take care of your clothes with attention to detail, allowing you to travel light and fully enjoy your stay without worrying about washing and ironing. Let us handle your laundry needs for maximum comfort.',
                'prix' => 80.0,
            ],
            [
                'nom' => 'Travel plan',
                'description' => ' A travel plan is a structured itinerary outlining your journey from start to finish. It typically includes details such as transportation arrangements, accommodation bookings, sightseeing activities, dining options, and any other relevant arrangements for your trip. ',
                'prix' => 70.0,
            ],
            [
                'nom' => 'Hire Driver',
                'description' => 'Explore the city and its surroundings conveniently with our private driver service. Avoid the hassles of driving and parking by letting our experienced drivers safely chauffeur you to your destinations. Enjoy a stress-free journey and focus on experiencing your destination.',
                'prix' => 30.0,
            ],
            [
                'nom' => 'Bar & Drink',
                'description' => 'Unwind and indulge in a refined selection of beverages at our stylish bar. From craft cocktails to exquisite wines, our bar offers a friendly and relaxing atmosphere for socializing or simply enjoying a moment of relaxation after a busy day.',
                'prix' => 20.0,
            ],
        ];

        // Création des services à partir des données
        foreach ($servicesData as $serviceData) {
            $service = new Services();
            $service->setNom($serviceData['nom']);
            $service->setDescription($serviceData['description']);
            $service->setPrix($serviceData['prix']);

            $manager->persist($service);
        }

        $manager->flush();
    }
}

