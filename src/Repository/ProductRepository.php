<?php

namespace App\Repository;

use App\Entity\Product;
use App\Helpers\FunctionsQueryHelper;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{

    private $functionsQueryHelper;

    public function __construct(ManagerRegistry $registry , FunctionsQueryHelper $functionsQueryHelper)
    {
        parent::__construct($registry, Product::class);
        $this->functionsQueryHelper = $functionsQueryHelper;
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



    /**
     * @param [type] $page
     * @param [type] $limit
     */
    public function findAllPb($page, $limit)
    {
        $query = $this->createQueryBuilder('p')
            ->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);
        return new Paginator($query);
    }




    /**
     * Return le nombre d'item en base de donnée
     */
    public function findCountData()
    {
        $namespace = __NAMESPACE__ . '\\';

        return $this->functionsQueryHelper->findCountData($namespace, get_class($this));
    }



}
