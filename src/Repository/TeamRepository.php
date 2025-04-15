<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Team>
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function createNewTeam(string $type, EntityManagerInterface $manager) : void
    {
        $newTeam = (new Team())
        ->setType($type)
        ->setAvailability(true)
        ;

        $manager->persist($newTeam);
        $manager->flush();
    }

    public function fetchTeam( int $id) : Team
    {
        $team = $this->find($id);

        return $team;
    }
}
