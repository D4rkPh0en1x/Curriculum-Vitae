<?php

namespace App\Repository;

use App\Entity\SelfEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Certifications|null find($id, $lockMode = null, $lockVersion = null)
 * @method Certifications|null findOneBy(array $criteria, array $orderBy = null)
 * @method Certifications[]    findAll()
 * @method Certifications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelfEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SelfEvaluation::class);
    }

//    /**
//     * @return Certifications[] Returns an array of Certifications objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Certifications
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
