<?php

namespace App\Repository;

use App\Entity\AcquiredSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AcquiredSkills|null find($id, $lockMode = null, $lockVersion = null)
 * @method AcquiredSkills|null findOneBy(array $criteria, array $orderBy = null)
 * @method AcquiredSkills[]    findAll()
 * @method AcquiredSkills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcquiredSkillsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AcquiredSkills::class);
    }

//    /**
//     * @return AcquiredSkills[] Returns an array of AcquiredSkills objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AcquiredSkills
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
