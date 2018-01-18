<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;


class AddController extends Controller
{
    /**
     * @Route("/folder/add", methods="POST")
     */
    public function addFolder(Request $request)
    {
        $carpeta = new Carpeta();
        $carpeta->setNombre($request->request->get('nombre'));

        $validator = $this->get('validator');
        $errors = $validator->validate($carpeta);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return $this->json([
                "msg" => "No se creo la carpeta",
                "err" => $errorsString
            ], 404);
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carpeta);
            $em->flush();
            return $this->json([
                "msg"  => "Carpeta creada con exito",
                "carpeta" => $carpeta->getNombre()]);
        }
    }


}