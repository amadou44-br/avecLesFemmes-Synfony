<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Groupement;
use App\Enum\StatutExercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExerciceFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [GroupementFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $groupement = $this->getReference(GroupementFixtures::REF . $i, Groupement::class);

            // Un exercice clôturé (2025)
            $manager->persist((new Exercice())
                ->setGroupement($groupement)
                ->setDebutAt(new \DateTime('2025-01-01'))
                ->setFinAt(new \DateTime('2025-12-31'))
                ->setLimitePretsAt(new \DateTime('2025-10-01'))
                ->setRetributionAt(new \DateTime('2026-01-15'))
                ->setStatut(StatutExercice::CLOTURE));

            // Un exercice en cours (2026)
            $manager->persist((new Exercice())
                ->setGroupement($groupement)
                ->setDebutAt(new \DateTime('2026-01-01'))
                ->setFinAt(new \DateTime('2026-12-31'))
                ->setLimitePretsAt(new \DateTime('2026-10-01'))
                ->setRetributionAt(new \DateTime('2027-01-15'))
                ->setStatut(StatutExercice::ENCOURS));
        }

        $manager->flush();
    }
}