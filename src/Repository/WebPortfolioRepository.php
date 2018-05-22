<?php

namespace App\Repository;

use App\Entity\WebPortfolio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WebPortfolio|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebPortfolio|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebPortfolio[]    findAll()
 * @method WebPortfolio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebPortfolioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WebPortfolio::class);
    }

//    /**
//     * @return WebPortfolio[] Returns an array of WebPortfolio objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WebPortfolio
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
