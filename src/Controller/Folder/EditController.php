<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;


class EditController extends Controller
{
    /**
     * @Route("/folder/edit/{slug}", methods="GET", name="folder-edit")
     */
    public function index(Request $request, string $slug)
    {
            $folder = $this->getDoctrine()
                ->getRepository(Folder::class)
                ->findOneBySlug($slug);
            if ($folder) {
                $em = $this->getDoctrine()->getManager();
                $carpeta->setNombre($request->request->get('nombre'));

                $validator = $this->get('validator');
                $errors = $validator->validate($carpeta);

                if (count($errors) > 0) {
                    $errorsString = (string)$errors;
                    return $this->json([
                        "msg" => "No se edito la carpeta",
                        "err" => $errorsString
                    ], 404);
                } else {
                    $em->persist($carpeta);
                    $em->flush();
                    return $this->json([
                        'msg' => 'Folder saved success',
                        'folder' => $carpeta->getNombre()
                    ]);
                }
            }
    }

}