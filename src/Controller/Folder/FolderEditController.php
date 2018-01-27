<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;
use App\Form\FolderType;

class FolderEditController extends Controller {

    /**
     * @Route("/folder/new", methods={"GEt", "POST"}, name="folder-new")
     */
    public function folderNew(Request $request) {

        $folder = new Folder();
        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $folder->setSlug(\App\Service\SlugGenerator::TokenizenSlug());

            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();
        }
        return $this->render('folder/folder-edit.html.twig', [
                    'title' => 'Nueva carpeta',
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/folder/edit/{slug}", methods="GET", name="folder-edit")
     */
    public function folderEdit(Request $request, string $slug) {
        $folder = $this->getDoctrine()
                ->getRepository(Folder::class)
                ->findOneBySlug($slug);
        if ($folder) {
            $em = $this->getDoctrine()->getManager();
            $carpeta->setNombre($request->request->get('nombre'));

            $validator = $this->get('validator');
            $errors = $validator->validate($carpeta);

            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return $this->json([
                            "msg" => "No se edito la carpeta",
                            "err" => $errorsString
                                ], 404);
            } else {
                $em->persist($carpeta);
                $em->flush();
                return $this->json([
                            'msg' => 'Folder saved success',
                            'folder' => $carpeta->getNombre()
                ]);
            }
        }
    }
    
    /**
     * @Route("/folder/delete/{slug}", methods="GET", name="folder-edit")
     */
    public function folderDelete(Request $request, string $slug) {
        
    }

}
