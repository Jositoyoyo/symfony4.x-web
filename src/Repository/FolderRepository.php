<?php
namespace App\Repository;

use App\Entity\Folder;
use App\Entity\Note;
use Doctrine\ORM\EntityManager;

class FolderRepository {

  private $em;
  public function __construct(EntityManager $em)
  {
      $this->em = $em;
  }
  public function findFolderAndCountItems()  {

     $folders = $this->em->getRepository(Folder::class)->findAll();
     if($folders){
     foreach ($folders as $folder) {
       $folder->setNotesCount($this->countNotesByFolder($folder->getId()));
     }
   }

     return $folders;

  }
  public function countNotesByFolder($id=null) : int {
    $items = $this->em->getRepository(Note::class)->createQueryBuilder('p')
          //  ->where('p.trash = :trash')
            ->andWhere('p.folder = :folder')
          //  ->setParameter('trash', 0)
            ->setParameter('folder', $id)
            ->getQuery()
            ->execute();
    return count($items);
  }
}
