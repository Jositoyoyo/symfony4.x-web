<?php

namespace App\Service;

use App\Entity\Carpeta;
use Doctrine\ORM\EntityManager;

class PapeleraService
{
    private $em;
    private $maxResults = 100;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function findAll()
    {
        return $this->em->createQuery(
            'SELECT p
                     FROM App\Entity\Nota p
                     WHERE p.papelera = :papelera
                     ORDER BY p.modificado ASC')
            ->setParameter('papelera', 0)
            ->setMaxResults($this->maxResults)
            ->setFirstResult(0)
            ->execute();
    }

    public function findNotasByCarpeta($carpeta)
    {
        $carpeta = $this->em->getRepository(Carpeta::class)
            ->findOneByNombre($carpeta);
        if($carpeta) {
            return $this->em->createQuery(
                    'SELECT p
                     FROM App\Entity\Nota p
                     WHERE p.carpeta = :carpeta
                     AND p.papelera = :papelera
                     ORDER BY p.modificado ASC')
                ->setParameters([
                    'carpeta' => $carpeta->getId(),
                    'papelera' => 0])
                ->setMaxResults($this->maxResults)
                ->execute();
        }
    }
}