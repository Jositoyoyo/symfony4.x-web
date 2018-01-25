<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;
use App\Repository\FolderRepository;

class FolderController extends Controller {

    /**
     * @var PostRepository
     */
    private $folderRepository;

    public function __construct(FolderRepository $folderRepository) {
        $this->folderRepository = $folderRepository;
    }

    /**
     * @Route("/folder", methods="GET", name="folder-index")
     */
    public function index() {

        $folders = $this->folderRepository->findFolderAndCountItems();
        return $this->render('folder/folder-index.html.twig', array(
                    'title' => 'Mostrar carpetas',
                    'folders' => $folders
        ));
    }

    /**
     * @Route("/folder/{slug}", methods="GET", name="folder-show")
     */
    public function folderShow($slug) {

        $folder = $this->getDoctrine()->getRepository(Folder::class)->findOneBySlug($slug);
        return $this->render('folder/folder-show.html.twig', array(
                    'title' => $folder->getName(),
                    'folder' => $folder,
                    'itemsCount' => count($folder)
        ));
    }

    /**
     * @Route("/folder/{slug}/items", methods="GET", name="folder-items")
     */
    public function showfindFolderAndItemsItems($slug) {

        $folder = $this->folderRepository->findFolderAndItems($slug);
        return $this->render('folder/folder-show.html.twig', array(
                    'title' => $folder->folder->getName(),
                    'folder' => $folder->folder,
                    'items' => $folder->items,
                    'itemsCount' => $folder->countItems
        ));
    }

}
