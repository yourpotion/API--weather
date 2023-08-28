<?php

namespace App\Repository;

use App\Entity\CheckInManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<CheckInManager>
* @implements PasswordUpgraderInterface<CheckInManager>
 *
 * @method CheckInManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckInManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckInManager[]    findAll()
 * @method CheckInManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckInManagerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckInManager::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    /**
     * @param PasswordAuthenticatedUserInterface $user
     * @param string $newHashedPassword
     * 
     * @return void
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof CheckInManager) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return CheckInManager[] Returns an array of CheckInManager objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CheckInManager
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
