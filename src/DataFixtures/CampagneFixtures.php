<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\TypeCampagne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CampagneFixtures extends Fixture implements DependentFixtureInterface
{
    public const REF = 'campagne_';

    public function getDependencies(): array
    {
        return [TypeCampagneFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $campagnes = [
            (new Campagne())
                ->setNom('Épargne annuelle 2026')
                ->setTypeCampagne($this->getReference(TypeCampagneFixtures::REF . 0, TypeCampagne::class))
                ->setDateDebutAt(new \DateTime('2026-01-01'))
                ->setDateFinAt(new \DateTime('2026-12-31'))
                ->setMontant(5000),
            (new Campagne())
                ->setNom('Caisse de solidarité')
                ->setTypeCampagne($this->getReference(TypeCampagneFixtures::REF . 1, TypeCampagne::class))
                ->setDateDebutAt(new \DateTime('2026-03-01'))
                ->setMontant(1000),
        ];

        foreach ($campagnes as $i => $campagne) {
            $manager->persist($campagne);
            $this->addReference(self::REF . $i, $campagne);
        }

        $manager->flush();
    }
}