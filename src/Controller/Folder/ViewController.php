<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;


class ViewController extends Controller
{
    /**
     * @Route("/folder/view/{slug}", methods="GET")
     */
    public function index(string $slug)
    {
        $folder = $this->getDoctrine()
            ->getRepository(Folder::class)
            ->findOneBySlug($slug);

        return $folder
            ? $this->render()
            : $this->render();

    }

}