<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\Membre;
use App\Entity\ModeCotisation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModeCotisationFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [CampagneFixtures::class, MembreFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 4; $i++) {
            $membre = $this->getReference(MembreFixtures::REF . $i, Membre::class);

            for ($j = 0; $j < 2; $j++) {
                $campagne = $this->getReference(CampagneFixtures::REF . $j, Campagne::class);

                $manager->persist((new ModeCotisation())
                    ->setMembre($membre)
                    ->setCampagne($campagne)
                    ->setIsLibre(($i + $j) % 2 === 0));
            }
        }

        $manager->flush();
    }
}