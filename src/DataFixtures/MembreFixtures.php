<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembreFixtures extends Fixture
{
    public const REF = 'membre_';

    public function load(ObjectManager $manager): void
    {
        $noms = ['Awa Diop', 'Fatou Ndiaye', 'Mariama Sow', 'Khady Fall'];

        foreach ($noms as $i => $nom) {
            $membre = (new Membre())->setNomComplet($nom);
            $manager->persist($membre);
            $this->addReference(self::REF . $i, $membre);
        }

        $manager->flush();
    }
}