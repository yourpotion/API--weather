<?php

namespace App\Repository;

use App\Entity\GateManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<GateManager>
* @implements PasswordUpgraderInterface<GateManager>
 *
 * @method GateManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method GateManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method GateManager[]    findAll()
 * @method GateManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GateManagerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GateManager::class);
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
        if (!$user instanceof GateManager) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return GateManager[] Returns an array of GateManager objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GateManager
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
