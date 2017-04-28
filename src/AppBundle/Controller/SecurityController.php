<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;

class SecurityController extends Controller
{
    /**
    * @Route("/login", name="login")
    */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
    * @Route("/register/{id}/{registration_token}", name="register")
    */
    public function registerAction(Request $request, User $user, $registration_token)
    {
        if ($user->getRegistrationToken() === null) {
            return $this->redirectToRoute('home');
        }

        $error = null;

        $csrf_token = $request->request->get('csrf_token');
        if ($csrf_token) {
            if (!$this->isCsrfTokenValid('register', $csrf_token)) {
                return $this->redirectToRoute('home');
            }

            if ($request->request->get('registration_token') !== $user->getRegistrationToken()) {
                return $this->redirectToRoute('home');
            }

            $plain_password = $request->request->get('password');
            $confirm_password = $request->request->get('confirm_password');

            if ($plain_password !== $confirm_password) {
                $error = 'Passwords didn\'t match';
            } elseif (strlen($plain_password < 6)) {
                $error = 'Password must be at least 6 characters';
            } else {
                $hash = $this
                    ->get('security.password_encoder')
                    ->encodePassword($user, $plain_password);
                $user
                    ->setPassword($hash)
                    ->setRegistrationToken(null);

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('security/register.html.twig', [
            'error' => $error,
            'user' => $user,
            'registration_token' => $registration_token
        ]);
    }
}
