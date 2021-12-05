<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findAllVisible()
 * @method Property[]    findLatest()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Query Returns the Query
     */    
    public function findAllVisibleQuery(PropertySearch $search) : Query
    {
        $query = $this->findVisibleQuery();

        if ($search->getMinSurface()) {
            $query = $query
                        ->andWhere('p.surface >= :minSurface')
                        ->setParameter('minSurface', $search->getMinSurface());
        }
        if ($search->getMaxPrice()) {
            $query = $query
                        ->andWhere('p.price <= :maxPrice')
                        ->setParameter('maxPrice', $search->getMaxPrice());
        }

        return $query->orderBy('p.id', 'ASC')->getQuery();
    }

    /**
     * @return Property[] Returns an array of Property objects
     */    
    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return QueryBuilder return the query Builder
     */    
    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false');
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
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
