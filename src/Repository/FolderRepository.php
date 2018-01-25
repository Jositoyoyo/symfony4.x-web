<?php

namespace App\Repository;

use App\Entity\Folder;
use App\Entity\Item;
use Doctrine\ORM\EntityManager;

class FolderRepository {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function findFolderAndCountItems() {

        $folders = $this->em->getRepository(Folder::class)
                ->createQueryBuilder('p')
                ->setMaxResults(100)
                ->getQuery()
                ->execute();
        if ($folders) {
            foreach ($folders as $folder) {
                $folder->setItemsCount($this->countNotesByFolder($folder->getId()));
            }
        }

        return $folders;
    }

    public function countNotesByFolder($id = null): int {
        $items = $this->em->getRepository(Item::class)
                ->createQueryBuilder('p')
                ->andwhere('p.trash = :trash')
                ->andWhere('p.folder = :folder')
                ->setParameter('trash', 0)
                ->setParameter('folder', $id)
                ->getQuery()
                ->execute();
        return count($items);
    }

    public function findFolderAndItems($slug) {

        $folder = new \stdClass();
        $folder->countItems = null;
        $folder->items = null;
        $folder->folder = $this->em->getRepository(Folder::class)->findOneBySlug($slug);

        if ($folder->folder) {
            $folder->items = $this->em->createQuery(
                    'SELECT p
                     FROM App\Entity\Item p
                     WHERE p.folder = :folder
                     AND p.trash = :trash
                     ORDER BY p.modify DESC')
                    ->setParameters([
                        'folder' => $folder->folder->getId(),
                        'trash' => 0])
                    ->setMaxResults(100)
                    ->execute();
            $folder->countItems = count($folder->items);
            return $folder;
        }

        return $folder;
    }

}
