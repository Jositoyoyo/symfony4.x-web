<?php

namespace App\Controller\User;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Carpeta;


class UserController extends Controller
{
    /**
     * @Route("/user", methods="GET")
     */
    public function index()
    {
        return $this->render('base.html.twig');

    }

   

}