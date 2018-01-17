<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;

class IndexController extends Controller {

    /**
     * @Route("/folder", methods="GET", name="folder-index")
     */
    public function index() {

        $folders = $this->getDoctrine()
                ->getRepository(Folder::class)
                ->findAll();

        return $folders ? $this->render('folder/index.html.twig', ['folders' => $folders]) :  $this->createNotFoundException('No product found for id '.$id);
        
    }

}
