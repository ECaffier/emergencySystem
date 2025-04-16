<?php

namespace App\Controller;

use App\Repository\CallerRepository;
use App\Repository\IncidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private CallerRepository $callerRepository,
        private IncidentRepository $incidentRepository
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $callers = $this->callerRepository->findAll();
        $incidents = $this->incidentRepository->findAll();

        return $this->render('home/index.html.twig', [
            'callers' => $callers,
            'incidents' => $incidents
        ]);
    }
} 