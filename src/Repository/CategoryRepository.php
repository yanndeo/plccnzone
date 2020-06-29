<?php

namespace App\Repository;

use App\Entity\Category;
use App\Helpers\FunctionsQueryHelper;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    private $functionsQueryHelper;

    public function __construct(ManagerRegistry $registry, FunctionsQueryHelper $functionsQueryHelper)
    {
        parent::__construct($registry, Category::class);

        $this->functionsQueryHelper = $functionsQueryHelper;
    }

    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
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
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */



    /**
     * Return le nombre d'item en base de donnée
     */
    public function findCountData()
    {
        return $this->functionsQueryHelper->findCountData(__NAMESPACE__ . '\\', get_class($this));
    }
}
