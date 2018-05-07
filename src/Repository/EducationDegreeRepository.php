<?php

namespace App\Repository;

use App\Entity\EducationDegree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EducationDegree|null find($id, $lockMode = null, $lockVersion = null)
 * @method EducationDegree|null findOneBy(array $criteria, array $orderBy = null)
 * @method EducationDegree[]    findAll()
 * @method EducationDegree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EducationDegreeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EducationDegree::class);
    }

//    /**
//     * @return EducationDegree[] Returns an array of EducationDegree objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EducationDegree
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
