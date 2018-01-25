<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Item;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function ItemsByUser(int $user) {
        return $this->em->getRepository(Item::class)
                        ->createQueryBuilder('p')
                        ->andWhere('p.user = :user')
                        ->setParameter('user', $user)
                        ->getQuery()
                        ->execute();
    }

    public function removeItemsByUser(int $user) {
        $items = $this->ItemsByUser($user);
        if ($items) {
            foreach ($items as $item) {
                $this->em->remove($item);
                $this->em->flush();
            }
        }
        return count($items);
    }

    public function loadUserByUsername($username) {
        return $this->createQueryBuilder('u')
                        ->where('u.username = :username OR u.email = :email')
                        ->setParameter('username', $username)
                        ->setParameter('email', $username)
                        ->getQuery()
                        ->getOneOrNullResult();
    }

}
