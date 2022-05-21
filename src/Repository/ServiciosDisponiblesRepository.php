<?php

namespace App\Repository;

use App\Entity\ServiciosDisponibles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiciosDisponibles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiciosDisponibles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiciosDisponibles[]    findAll()
 * @method ServiciosDisponibles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiciosDisponiblesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiciosDisponibles::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ServiciosDisponibles $entity, bool $flush = true): void
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
    public function remove(ServiciosDisponibles $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getServicio(int $servicio_id): ServiciosDisponibles
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :servicio_id')
            ->setParameter('servicio_id', $servicio_id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return ServiciosDisponibles
    //  */
    // public function getServicio(int $id_servicio)
    // {
    //     $entityManager = $this->getEntityManager();

    //     $result =  $entityManager->createQuery(
    //         'SELECT p
    //         FROM App\Entity\ServiciosDisponibles p
    //         WHERE p.id > :id_servicio'
    //     )->setParameter('id_servicio', $id_servicio);

    //     // returns an array of Product objects
    //     return $result->getResult();
    // }

    // /**
    //  * @return ServiciosDisponibles[] Returns an array of ServiciosDisponibles objects
    //  */
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
    public function findOneBySomeField($value): ?ServiciosDisponibles
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
