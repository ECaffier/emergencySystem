<?php

namespace App\Service;

use App\Entity\Caller;
use App\Entity\Operator;
use App\Entity\Team;
use App\Repository\IncidentRepository;
use PhpParser\Node\Stmt\TryCatch;

class IncidentService
{
    private $incidentRepository;
    public function __construct(IncidentRepository $incidentRepository)
    {
        $this->incidentRepository = $incidentRepository;
    }
    public function newIncident(
        string $localisation, 
        string $description,
        Caller $caller,
    ): string
    {
        try {
            $incident = $this->incidentRepository->reportIncident(
                $localisation, 
                $description,
                $caller,
            );
            return 'Incident enregistré avec succès';
        } catch (\Exception $e) {
            // Ici, tu peux logger l'erreur si tu veux
            return 'Erreur lors de l\'enregistrement de l\'incident: ' . $e->getMessage();
        }
    }
    
}
