<?php

namespace App\Repository;

use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokemon>
 *
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    // public function add(Pokemon $entity, bool $flush = false): void
    // {
    //     $this->getEntityManager()->persist($entity);

    //     if ($flush) {
    //         $this->getEntityManager()->flush();
    //     }
    // }

    // public function remove(Pokemon $entity, bool $flush = false): void
    // {
    //     $this->getEntityManager()->remove($entity);

    //     if ($flush) {
    //         $this->getEntityManager()->flush();
    //     }
    // }


   public function findAllPokemon()
   {
       return $this->createQueryBuilder('p')
           ->select('p')
           ->leftJoin('p.stats', 's')
           ->addSelect('s')
           ->leftJoin('p.types', 't')
           ->addSelect('t')
           ->getQuery()
           ->getResult()
       ;
   }

      /**
    * @return Type[] Returns an array of Pokemon by type objects
    */
   public function findPokemonByType($type_id): array
   {
       return $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.stats', 's')
            ->addSelect('s')
            ->leftJoin('p.types', 't')
            ->addSelect('t')
            ->andWhere('t.id = :type_id')
            ->setParameter('type_id', $type_id)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
       ;
   }



}
