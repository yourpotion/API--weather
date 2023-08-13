<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserCity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserCity>
 *
 * @method UserCity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCity[]    findAll()
 * @method UserCity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCity::class);
    }

    /**
     * @param UserCity $userCity
     * 
     * @return void
     */
    public function save(UserCity $userCity): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($userCity);
        $entityManager->flush();
    }

    /**
     * @param UserCity $userCity
     * 
     * @return void
     */
    public function remove(UserCity $userCity): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($userCity);
        $entityManager->flush();
    }

    //    /**
    //     * @return UserCity[] Returns an array of UserCity objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserCity
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
