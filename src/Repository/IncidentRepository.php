<?php

namespace App\Repository;

use App\Entity\Caller;
use App\Entity\Incident;
use App\Entity\Operator;
use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Incident>
 */
class IncidentRepository extends ServiceEntityRepository
{
    private $manager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Incident::class);
        $this->manager = $manager;
    }

    public function reportIncident(
        string $localisation, 
        string $description,
        Caller $callerId,
    ) : void
    {
        $newIncident = (new Incident)
        ->setLocalisation($localisation)
        ->setDescription($description)
        ->setStatus("en cours")
        ->setReportedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris')))
        ->setCallerId($callerId)
        ;

        $this->manager->persist($newIncident);
        $this->manager->flush();
    }

    public function fetchIncident(int $id): Incident
    {
        $incident = $this->find($id);

        return $incident;
    }

    public function editStatusIncident(int $id): void
    {
        $incident = $this->fetchIncident($id);
        $incident->setStatus("terminé");
    }

}
