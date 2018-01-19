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
        return $this->render('folder/index.html.twig', array(
                    'title' => 'Mostrar carpetas',
                    'folders' => $folders
        ));
    }

    /**
     * @Route("/folder/{slug}/items", methods="GET", name="folder-items")
     */
    public function showFolderItems($slug) {

        $result = $this->folderRepository->findfolderAndItems($slug);
        return $this->render('folder/folder-items.html.twig', array(
                    'title' => $result->folder->getName(),
                    'folder' => $result->folder,
                    'items' => $result->items,
                    'itemsCount' => $result->countItems
        ));
    }

}
