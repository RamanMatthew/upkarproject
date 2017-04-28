<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

/**
* @Security("has_role('ROLE_ADMIN')")
*/
class UsersController extends Controller
{
    /**
    * @Route("/users", name="user-index")
    */
    public function indexAction()
    {
        $users = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:User')
        ->findAll();

        return $this->render('users/index.html.twig', compact('users'));
    }

    /**
    * @Route("/users/create", name="user-create")
    */
    public function createAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $token = $this->get('app.crypt')->randString(64);
            $em = $this->getDoctrine()->getManager();
            $user
            ->setPassword('temp')
            ->setRegistrationToken($token);
            $em->persist($user);
            $em->flush();

            // 'http://upkar_project.dev/register/'.$user->getRregistrationToken().'/'.$token

            return $this->redirectToRoute('user-index');
        }

        return $this->render('users/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/users/{id}/edit", name="user-edit")
    */
    public function editAction(Request $request, User $user)
    {
        if ($user->getRole() === 'ROLE_ADMIN') {
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            if ($request->request->get('delete')) {
                $em->remove($user);
                $em->flush();

                return $this->redirectToRoute('user-index');
            } elseif ($form->isValid()) {
                if ($user->getRole() === 'ROLE_ADMIN') {
                    return $this->redirectToRoute('home');
                }

                $em->flush();
                return $this->redirectToRoute('user-index');
            }
        }

        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
