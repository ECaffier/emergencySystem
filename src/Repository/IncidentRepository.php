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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Incident::class);
    }

    public function reportIncident(
        string $localisation, 
        string $description,
        Caller $callerId,
        Operator $operatorid,
        Team $teamId,
        EntityManagerInterface $manager
    ) : void
    {
        $newIncident = (new Incident)
        ->setLocalisation($localisation)
        ->setDescription($description)
        ->setStatus("en cours")
        ->setReportedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris')))
        ->setCallerId($callerId)
        ->setOperatorId($operatorid)
        ->setTeamId($teamId)
        ;

        $manager->persist($newIncident);
        $manager->flush();
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
