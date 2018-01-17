<?php

namespace App\Repository;

use App\Entity\Carpeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CarpetaRepository extends ServiceEntityRepository
{
    public function __construct()
    {
        parent::__construct(RegistryInterface::class, Carpeta::class);
    }

    /**
     * @param $price
     * @return Product[]
     */
    public function findAllGreaterThanPrice($price)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.price > :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        return $qb->execute();

        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();
    }
}