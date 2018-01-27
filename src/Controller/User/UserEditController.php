<?php

namespace App\Controller\User;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserEditController extends Controller {

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/user/new", methods={"GET", "POST"}, name="user-new")
     */
    public function userNew(Request $request, UserPasswordEncoderInterface $encoded) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword($encoded->encodePassword($user, $user->getPlainPassword()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('notice', 'Datos actualizados con exito');

            return $this->redirectToRoute('user-edit', ['username' => $user->getUsername()]);
        }
        return $this->render('user/user-edit.html.twig', [
                    'title' => 'Nueva Usuario',
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{username}/edit", methods={"GET", "POST"}, name="user-edit")
     */
    public function userEdit(Request $request, $username, UserPasswordEncoderInterface $encoded) {

        $user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername($username);

        if ($user) {

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $user->setPassword($encoded->encodePassword($user, $user->getPlainPassword()));

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Datos actualizados con exito');

                return $this->redirectToRoute('user-edit', ['username' => $user->getUsername()]);
            }
        }
        return $this->render('user/user-edit.html.twig', array(
                    'title' => $user->getUsername(),
                    'form' => $form->createView(),
                    'user' => $user
        ));
    }

    /**
     * @Route("/user/{username}/delete", methods={"GET", "POST"}, name="user-delete")
     */
    public function userDelete(Request $request, $username) {

        if ($user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername($username)) {

            $delete = $this->userRepository->removeItemsByUser($user->getId());

            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            $this->addFlash('notice', 'Se borro el usuario ' . $username);
            $this->addFlash('notice', 'Se borro ' . $delete . ' items');

            return $this->redirectToRoute('user-index');
        }
        $this->addFlash('notice', 'No se borro el usuario ' . $username);
        return $this->redirectToRoute('user-index');
    }

}
