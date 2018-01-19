<?php

namespace App\Controller\Item;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Note;
use App\Entity\Carpeta;
use App\Service\SlugGenerator;
use App\Form\NoteType;

class AddItemController extends Controller {

    /**
     * @Route("/note/add", methods={"GET", "POST"}, name="note-add")
     */
    public function noteadd(Request $request) {

        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $note = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('note-index');
        }
        return $this->render('folder/folder-items.html.twig', [
                    'title' => 'Nueva nota',
                    'form' => $form->createView(),
        ]);
        
    }

}
