<?php

namespace App\Repository;

use App\Entity\Supervisor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Supervisor>
 * @implements PasswordUpgraderInterface<Supervisor>
 *
 * @method Supervisor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supervisor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supervisor[]    findAll()
 * @method Supervisor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupervisorRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supervisor::class);
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
        if (!$user instanceof Supervisor) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return Supervisor[] Returns an array of Supervisor objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Supervisor
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
