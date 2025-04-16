<?php

namespace App\Controller;

use App\Service\IncidentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IncidentController extends AbstractController
{
    private $incidentService;
    public function __construct(IncidentService $incidentService)
    {
        $this->incidentService = $incidentService;
    }
    #[Route('/incident', name: 'app_incident')]
    public function incident(Request $request): Response
    {
        $callerId = $request->get('caller');
        $localisation = $request->get('localisation');
        $description = $request->get('description');

        $newIncident = $this->incidentService->newIncident(
            $localisation, 
            $description,
            $callerId,
        );
        
        return $this->render('incident/index.html.twig', [
            'controller_name' => 'IncidentController',
        ]);
    }
}
