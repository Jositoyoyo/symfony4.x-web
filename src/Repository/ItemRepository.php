<?php

namespace App\Repository;

use App\Entity\Folder;
use App\Entity\Item;
use Doctrine\ORM\EntityManager;

class ItemRepository {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function findByLastModify() {
        return $this->em->getRepository(Item::class)
                        ->createQueryBuilder('p')
                        ->andwhere('p.trash = :trash')
                        ->orderBy('p.modify', 'DESC')
                        ->setParameter('trash', 0)
                        ->setMaxResults(30)
                        ->getQuery()
                        ->execute();
    }

}
