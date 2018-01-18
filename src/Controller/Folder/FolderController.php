<?php
namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;

class FolderController extends Controller {

    /**
     * @Route("/folder", methods="GET", name="folder-index")
     */
    public function index() {

        $doctrine = $this->getDoctrine();
        $folders = $doctrine->getRepository(Folder::class)
                ->createQueryBuilder('p')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(100)
                ->getQuery()
                ->execute();
        
        return $this->render('folder/index.html.twig', array(
                    'title' => 'Folders',
                    'folders' => $folders
        ));
    }

}
