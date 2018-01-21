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
     * @Route("/users", methods="GET", name="user-index")
     */
    public function index() {
      $users = $this->getDoctrine()->getRepository(User::class)
          ->findAll();
          this->render('user/user-index.html-twig', [ 'users' => $users ])
    }



}
