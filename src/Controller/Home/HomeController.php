<?php

namespace App\Controller\Home;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Item;

class HomeController extends Controller {

    /**
     * @Route("/home", methods="GET", name="home-index")
     */
    public function index() {

        $items = $this->getDoctrine()->getRepository(Item::class)->findAll();

        return $this->render('home/home-index.html.twig', array(
                    'title' => 'Home',
                    'items' => $items
        ));
    }

}
