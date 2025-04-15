<?php

namespace App\Repository;

use App\Entity\Operator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Operator>
 */
class OperatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operator::class);
    }

    public function createNewOperator(string $name, EntityManagerInterface $manager) : void
    {
        $newOperator = (new Operator())
        ->setName($name);

        $manager->persist($newOperator);
        $manager->flush();
    }

    public function fetchOperator( int $id) : Operator
    {
        $operator = $this->find($id);

        return $operator;
    }
}
