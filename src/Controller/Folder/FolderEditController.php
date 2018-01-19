<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;
use App\Form\FolderType;
use App\Service\SlugGenerator;

class FolderEditController extends Controller {

    /**
     * @Route("/folder/new", methods={"GET", "POST"}, name="folder-idex")
     */
    public function newFolder(Request $request) {

        $folder = new Folder();
        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $folder->setSlug(SlugGenerator::TokenizenSlug($folder->getName()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            return $this->redirectToRoute('folder-index');
        }
        return $this->render('folder/folder-new.html.twig', [
                    'title' => 'Nueva carpeta',
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/folder/edit/{slug}", methods={"GET", "POST"}, name="folder-edit")
     */
    public function editFolder(Request $request, Folder $folder) {

        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $folder->setSlug(SlugGenerator::TokenizenSlug($folder->getName()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            return $this->redirectToRoute('folder-index');
        }
        return $this->render('folder/folder-new.html.twig', [
                    'title' => 'Nueva carpeta',
                    'form' => $form->createView(),
        ]);
    }

}
