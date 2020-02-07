<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByCoeur()
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->where('p.coeur = 1')
            ->orderBy('p.prix' , 'DESC')
            ->getQuery();

        return $queryBuilder->setMaxResults(1)->getOneOrNullResult();
    }

    public function findByDerDate()
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->orderBy('p.date','DESC')
            ->getQuery();

        return $queryBuilder->setMaxResults(1)->getOneOrNullResult();
    }

    public function findByDate():array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->orderBy('p.date','DESC')
            ->setMaxResults(4)
            ->getQuery();

        return $queryBuilder->getResult();
    }




    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
