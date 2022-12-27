<?php

namespace App\Repository;

use App\Entity\Information;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Information>
 *
 * @method Information|null find($id, $lockMode = null, $lockVersion = null)
 * @method Information|null findOneBy(array $criteria, array $orderBy = null)
 * @method Information[]    findAll()
 * @method Information[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Information::class);
    }

    public function getComments(int $id): array
    {
        $qb = $this->createQueryBuilder('i');

        $qb->select('i.content', 'u.email AS user')
            ->where('i.application = :application_id')
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'u = i.user')
            ->setParameter('application_id', $id);

        return $qb->getQuery()->getArrayResult();
    }
}
