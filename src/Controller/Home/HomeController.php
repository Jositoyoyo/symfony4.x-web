<?php

namespace App\Controller\Home;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Note;
use App\Entity\Todo;

class HomeController extends Controller {

    /**
     * @Route("/", methods="GET", name="home-index")
     */
    public function home() {

        $doctrine = $this->getDoctrine();

        $notes = $doctrine->getRepository(Note::class)
                ->createQueryBuilder('p')
                ->where('p.trash > :trash')
                ->setParameter('trash', false)
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(100)
                ->getQuery()
                ->execute();

        return $this->render('home/index.html.twig', array(
        'title' => 'Home',
        'notes' => $notes
                ));
    }

}
