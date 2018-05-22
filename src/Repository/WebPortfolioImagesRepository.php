<?php

namespace App\Repository;

use App\Entity\WebPortfolioImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WebPortfolioImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebPortfolioImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebPortfolioImages[]    findAll()
 * @method WebPortfolioImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebPortfolioImagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WebPortfolioImages::class);
    }

//    /**
//     * @return WebPortfolioImages[] Returns an array of WebPortfolioImages objects
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
    public function findOneBySomeField($value): ?WebPortfolioImages
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
