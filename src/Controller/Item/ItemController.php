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
     * @Route("/items", methods="GET", name="item-index")
     */
    public function index() {
        $items = $this->itemRepository->findByLastModify();
        return $this->render('item/Item-index.html.twig', ['title' => 'ultimos items', 'items' => $items]);
    }

    /**
     * @Route("/items/folder/{slug}", methods="GET", name="items-by-folder")
     */
    public function itemsByFolder($slug) {
        $items = $this->itemRepository->findByFolder($slug);
        var_dump($items);
    }

    /**
     * @Route("/item/view/{slug}", methods="GET", name="item-view")
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
