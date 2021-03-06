<?php

namespace App\Controller\Item;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;
use App\Entity\Item;
use App\Form\ItemType;

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
            $item->setCreated(new \DateTime());
            $item->setSlug(\App\Service\SlugGenerator::TokenizenSlug());
            $item->setTrash(0);
            $item->setUser($this->getUser());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            //return $this->redirectToRoute('item-index');
        }
        return $this->render('item/item-edit.html.twig', [
                    'title' => 'Nuevo item',
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("folder/{slug}/item/new/", methods={"GET", "POST"}, name="folder-item-new")
     */
    public function FolderItemNew(Request $request, string $slug) {
        $folder = $this->getDoctrine()->getRepository(Folder::class)->findOneBySlug($slug);
        if ($folder) {
            $item = new Item();
            $item->setFolder($folder);
            $form = $this->createForm(ItemType::class, $item);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $item = $form->getData();
                $item->setCreated(new \DateTime());
                $item->setSlug(\App\Service\SlugGenerator::TokenizenSlug());
                $item->setTrash(0);

                $em = $this->getDoctrine()->getManager();
                $em->persist($item);
                $em->flush();
                //return $this->redirectToRoute('item-index');
            }
            return $this->render('item/item-edit.html.twig', [
                        'title' => 'Nuevo item',
                        'form' => $form->createView(),
            ]);
        }
    }

}
