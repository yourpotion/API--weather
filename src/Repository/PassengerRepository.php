<?php

namespace App\Repository;

use App\Entity\Passenger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Passenger>
* @implements PasswordUpgraderInterface<Passenger>
 *
 * @method Passenger|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passenger|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passenger[]    findAll()
 * @method Passenger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassengerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passenger::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Passenger) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
    /**
     * @param Passenger $passenger
     * 
     * @return void
     */
    public function save(Passenger $passenger): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($passenger);
        $entityManager->flush();
    }

    /**
     * @param Passenger $passenger
     * 
     * @return void
     */
    public function remove(Passenger $passenger): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($passenger);
        $entityManager->flush();
    }

//    /**
//     * @return Passenger[] Returns an array of Passenger objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Passenger
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
