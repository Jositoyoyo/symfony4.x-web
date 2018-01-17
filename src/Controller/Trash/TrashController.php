<?php

namespace App\Controller\Trash;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Nota;
use App\Entity\Carpeta;
use App\Service\SlugGenerator;
use App\Service\PapeleraService;

class TrashController extends Controller
{
    /**
     * @Route("/trash", methods="GET")
     */
    public function index()
    {
        $note = $this->getDoctrine()->getRepository(Nota::class)
            ->findByPapelera(true);

        return $note
            ? $this->json(['notas' => $notas])
            : $this->json(['notas' => null],404);

    }

    /**
     * @Route("/trash/delete/all", methods="POST")
     */
    public function delete()
    {
    }

    /**
     * @Route("/papelera/recuperar/{elemento}", methods="POST")
     */
    public function recover()
    {
    }

}