<?php

namespace App\Repository;

use App\Entity\TipoTerapia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoTerapia|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoTerapia|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoTerapia[]    findAll()
 * @method TipoTerapia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoTerapiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoTerapia::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TipoTerapia $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(TipoTerapia $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function findTerapias()
    {
        return $this->createQueryBuilder('r')
            ->select('r.NombreTerapia')
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function findServiciosbyName($name)
    {
        return $this->createQueryBuilder('p')
            ->where('p.NombreTerapia = :name')
            ->setParameter('name', $name)
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return TipoTerapia[] Returns an array of TipoTerapia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoTerapia
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
