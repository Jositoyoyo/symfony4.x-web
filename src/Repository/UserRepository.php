<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserRepository {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function ItemsByFolder($folder = null) {
        return $this->em->getRepository(Item::class)
                        ->createQueryBuilder('p')
                        ->andwhere('p.trash = :trash')
                        ->andWhere('p.folder = :folder')
                        ->setParameter('trash', 0)
                        ->setParameter('folder', $folder)
                        ->getQuery()
                        ->execute();
    }

}
