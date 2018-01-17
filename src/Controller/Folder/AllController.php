<?php

namespace App\Controller\Folder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Folder;


class AllController extends Controller
{
    /**
     * @Route("/folder", methods="GET", name="folder_index")
     */
    public function index()
    {
        $folders = $this->getDoctrine()
            ->getRepository(Carpeta::class)
            ->findAll();

        return $folders
        ? $this->render()
        : $this->render();

    }

    /**
     * @Route("/folder/view/{name}", methods="GET")
     */
    public function view(string $nombre=null)
    {
        $carpeta = $this->getDoctrine()
            ->getRepository(Carpeta::class)
            ->findOneByNombre($nombre);

        return $carpeta
            ? $this->json([
                'msg' => 'Carpeta encontrada',
                'carpeta' => $carpeta
            ])
            : $this->json(['msg' => 'Carpeta no encontrada'],404);

    }

    /**
     * @Route("/folder/add", methods="POST")
     */
    public function add(Request $request)
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

    /**
     * @Route("/folder/edit/{name}", methods="POST")
     */
    public function edit(Request $request, $name=null)
    {
            $carpeta = $this->getDoctrine()
                ->getRepository(Carpeta::class)
                ->findOneByNombre($name);
            
            if ($carpeta) {
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