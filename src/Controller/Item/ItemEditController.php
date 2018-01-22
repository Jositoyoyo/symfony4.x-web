<?php

namespace App\Controller\Item;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Item;
use App\Form\ItemType;
use App\Service\SlugGenerator;

class ItemEditController extends Controller {

    /**
     * @Route("/item/new", methods={"GET", "POST"}, name="item-new")
     */
    public function itemNew(Request $request) {

        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $item = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('note-index');
        }
        return $this->render('item/item-edit.html.twig', [
                    'title' => 'Nueva nota',
                    'form' => $form->createView(),
        ]);
    }

}
