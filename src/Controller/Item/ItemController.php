<?php

namespace App\Controller\Item;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Item;
use App\Repository\ItemRepository;

class ItemController extends Controller {

    /**
     * @var ItemRepository
     */
    private $itemRepository;

    public function __construct(ItemRepository $itemRepository) {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @Route("/items", methods="GET", name="note-index")
     */
    public function index() {
        
    }

    /**
     * @Route("/items/folder/{slug}", methods="GET", name="note-folder")
     */
    public function itemsInFolder() {
        $this->itemRepository->ItemsByFolder($slug);
    }

    /**
     * @Route("/item/view/{slug}", methods="GET", name="note-view")
     */
    public function itemView($slug) {

        $item = $doctrine = $this->getDoctrine()->getRepository(Item::class)
                ->findOneBy(array('slug' => $slug));

        return $this->render('item/item-view.html.twig', [
                    'title' => $item->getTitle(),
                    'item' => $item
        ]);
    }

}
