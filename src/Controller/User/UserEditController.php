<?php

namespace App\Controller\User;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserEditController extends Controller {

    /**
     * @Route("/user/new", methods={"GET", "POST"}, name="user-new")
     */
    public function userNew(Request $request) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            //$em->persist($user);
            //$em->flush();

            return $this->redirectToRoute('user-index');
        }
        return $this->render('user/user-edit.html.twig', [
                    'title' => 'Nueva Usuario',
                    'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/user/{username}/edit", methods={"GET", "POST"}, name="user-edit")
     */
    public function userEdit(Request $request, $username) {
        $user  = $this->getDoctrine()->getRepository(User::class)->findOneByUsername($username);
        return $this->render('', [$user])
    }

}
