<?php

namespace App\Controller\Home;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Nota;

class HomeController extends Controller
{
    /**
     * @Route("/home", methods="GET", name="home_index")
     */
    public function index()
    {
       return new Response("hello");
        
    }

    

}