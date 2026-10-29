<?php

namespace App\DataFixtures;

use App\Entity\TypeCampagne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeCampagneFixtures extends Fixture
{
    public const REF = 'type_campagne_';

    public function load(ObjectManager $manager): void
    {
        foreach (['Épargne', 'Solidarité'] as $i => $nom) {
            $type = (new TypeCampagne())->setNom($nom);
            $manager->persist($type);
            $this->addReference(self::REF . $i, $type);
        }

        $manager->flush();
    }
}