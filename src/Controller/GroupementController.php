<?php

namespace App\Controller;

use App\Entity\Groupement;
use App\Repository\GroupementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GroupementController extends AbstractController
{
    public function __construct(private readonly GroupementRepository $repo)
    {
    }

    #[Route('/groupement', name: 'app_groupement')]
    public function index(): Response
    {
        return $this->render('groupement/index.html.twig', [
            'groupements' => $this->repo->findAll(),
        ]);
    }

    #[Route('/groupement/{id}', name: 'app_groupement_show', requirements: ['id' => '\d+'])]
    public function show(Groupement $groupement): Response
    {
        return $this->render('groupement/show.html.twig', [
            'groupement' => $groupement,
            'exercicesEnCours' => $groupement->getExercicesEnCours(),
        ]);
    }
}