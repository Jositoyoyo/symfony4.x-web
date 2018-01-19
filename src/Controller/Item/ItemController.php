<?php

namespace App\Controller\Item;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Nota;
use App\Entity\Carpeta;
use App\Service\SlugGenerator;
use App\Service\CarpetaNotasService;

class ItemController extends Controller
{
    /**
     * @Route("/notes", methods="GET", name="note-index")
     */
    public function index()
    {
        $notes = $this->container
            ->get(CarpetaNotasService::class)
            ->findByLastModifiqued();

        return $this->render('note/index.html.twig', ['notes' => $notes]);
        
    }

    /**
     * @Route("/note/view/{id}", methods="GET")
     */
    public function view($id)
    {
        $note = $this->getDoctrine()
            ->getRepository(Nota::class)
            ->findOneBySlug($id);

        return $note
            ? $this->json(['note' => $note])
            : $this->json(['note' => null], 404);

    }

    /**
     * @Route("/nota/add/note", methods="POST")
     */
    public function add(Request $request){

        $carpeta = $this->getDoctrine()
            ->getRepository(Carpeta::class)
            ->findOneByNombre($request->request->get('carpeta'));

        if($carpeta) {
            $fechaHoy = new \DateTime();
            $nota = new Nota();
            $nota->setCreado($fechaHoy);
            $nota->setModificado($fechaHoy);
            $nota->setPrioridad($request->request->get('prioridad'));
            $nota->setTitulo($request->request->get('titulo'));
            $nota->setSlug(SlugGenerator::slugify($request->request->get('titulo')));
            $nota->setContenido($request->request->get('contenido'));
            $nota->setEtiqueta($request->request->get('etiqueta'));
            $nota->setPapelera(0);
            $nota->setCarpeta($carpeta);

            $validator = $this->get('validator');
            $errors = $validator->validate($nota);

            if (count($errors) > 0) {
                $errorsString = (string)$errors;
                return $this->json(["error" => $errorsString], 404);
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($nota);
                $em->flush();
                return $this->json([
                    "msg" => "Nota guardada con exito",
                    'carpeta' => $carpeta,
                    "nota" => $nota->getId()]);
            }
        } else {
            return $this->json([
                'msg' => 'No se encontro la carpeta'
            ]);
        }

    }
    /**
     * @Route("/note/edit/{slug}", methods="POST")
     */
    public function edit(Request $request, string $slug)
    {
        $note = $this->getDoctrine()
            ->getRepository(Nota::class)
            ->findOneBySlug($slug);

        if($note){
            
            $today = new \DateTime();
            $note->setModificado($today);
            $note->setPrioridad($request->request->get('prioridad'));
            $note->setTitulo($request->request->get('titulo'));
            $note->setSlug(SlugGenerator::slugify($request->request->get('titulo')));
            $note->setContenido($request->request->get('contenido'));
            $note->setEtiqueta($request->request->get('etiqueta'));
            $note->setPapelera(0);
            
            $validator = $this->get('validator');
            $errors = $validator->validate($note);

            if (count($errors) > 0) {
                $errorsString = (string)$errors;
                return $this->json(["error" => $errorsString]);
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($note);
                $em->flush();
                return $this->json([
                    "msg" => "Note edit success",
                    "nota" => $note->getTitulo()]);
            }
        } else {
            return $this->json([
                'msg' => 'note no found'], 404);
        }
    }

    /**
     * @Route("/nota/move/{nota}", methods="POST")
     */
    public function move(Request $request, string $nota)
    {
        $nota = $this->getDoctrine()
            ->getRepository(Nota::class)
            ->findOneById($nota);

        $dest =  $this->getDoctrine()
            ->getRepository(Carpeta::class)
            ->findOneByNombre($request->request->get('carpeta'));

        if($dest){
            $nota->setCarpeta($dest);
            $em = $this->getDoctrine()->getManager();
            $em->persist($nota);
            $em->flush();
            return $this->json([
                "msg" => "Nota movida con exito",
                'carpeta' => $dest,
                "nota" => $nota->getTitulo()]);
        } else {
            return $this->json(['msg' => 'la carpta no existe']);
        }
    }

    /**
     * @Route("/note/trash/{slug}", methods="POST")
     */
    public function trash(Request $request, string $slug=null){

        $note = $this->getDoctrine()
            ->getRepository(Nota::class)
            ->findOneBySlug($slug);

        if($note) {
            $note->setPapelera(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            return $this->json([
                "msg" => "Success",
                "nota" => $note->getTitulo()
            ]);
        } else {
            return $this->json([
                "msg" => "Note no found"
            ], 404);

        }

    }

    /**
     * @Route("/{carpeta}/notas", methods="GET")
     */
    public function notasByCarpeta($carpeta=null)
    {
        $notas = $this->container
            ->get(CarpetaNotasService::class)
            ->findNotasByCarpeta($carpeta);

        if($notas) {
            return $this->json([
                'msg' => 'Notas encontradas',
                'carpeta' => $carpeta,
                'notas' => $notas
            ]);
        } else {
            return $this->json([
                'msg' => "No ha resultados",
                'carpeta' => $carpeta
            ], 404);
        }
    }

}