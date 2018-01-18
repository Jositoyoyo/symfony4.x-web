<?php

namespace App\Controller\Home;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Nota;
use App\Entity\Todo;

class HomeController extends Controller
{
    /**
     * @Route("/", methods="GET", name="index")
     */
    public function index() void {
        $this->home();
    }
    /**
     * @Route("/home", methods="GET", name="home_index")
     */
    public function home() {
        
       $doctrine = $this->getDoctrine();
       
       $todo = $doctrine->getRepository(Note::class)
                ->createQueryBuilder('p')
                ->where('p.trash > :trash')
                ->setParameter('trash', false)
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(100)
                ->getQuery()
                ->execute();
       
       return $this->render('base.html.twig', array(
           'todo' => $todo)
       ));
        
    }

    

}