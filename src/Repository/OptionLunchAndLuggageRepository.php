<?php

namespace App\Repository;

use App\Entity\OptionLunchAndLuggage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Option>
 *
 * @method OptionLunchAndLuggageRepository|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionLunchAndLuggageRepository|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionLunchAndLuggageRepository[]    findAll()
 * @method OptionLunchAndLuggageRepository[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionLunchAndLuggageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionLunchAndLuggage::class);
    }
    
    /**
     * @param OptionLunchAndLuggage $optionLunchAndLuggage
     * 
     * @return void
     */
    public function save(OptionLunchAndLuggage $optionLunchAndLuggage): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($optionLunchAndLuggage);
        $entityManager->flush();
    }

    /**
     * @param OptionLunchAndLuggage $optionLunchAndLuggage
     * 
     * @return void
     */
    public function remove(OptionLunchAndLuggage $optionLunchAndLuggage): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($optionLunchAndLuggage);
        $entityManager->flush();
    }
//    /**
//     * @return Option[] Returns an array of Option objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Option
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
