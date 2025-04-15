<?php

namespace App\Repository;

use App\Entity\Caller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Caller>
 */
class CallerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caller::class);
    }

    public function createNewCaller(string $name, string $phone, EntityManagerInterface $manager):void
    {
        $newCaller = (new Caller())
        ->setName($name)
        ->setPhone($phone)
        ;

        $manager->persist($newCaller);
        $manager->flush();


    } 
    public function fetchCaller( int $id ) : Caller 
    {
        $caller = $this->find($id);

        return $caller;
    } 
}
