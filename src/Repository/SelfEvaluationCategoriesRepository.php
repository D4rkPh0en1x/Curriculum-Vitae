<?php

namespace App\Repository;

use App\Entity\SelfEvaluationCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SelfEvaluationCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelfEvaluationCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelfEvaluationCategories[]    findAll()
 * @method SelfEvaluationCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelfEvaluationCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SelfEvaluationCategories::class);
    }

//    /**
//     * @return SelfEvaluationCategories[] Returns an array of SelfEvaluationCategories objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SelfEvaluationCategories
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
