<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/teaching-methodology", name="teaching-methodology")
     */
    public function showAction()
    {
        return $this->render('layouts/teaching.html.twig', [
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('layouts/contact.html.twig', [
        ]);
    }

    /**
     * @Route("/learning-environment", name="learning-environment")
     */
    public function learningAction()
    {
        return $this->render('layouts/learning.html.twig', [
        ]);
    }

    /**
     * @Route("/meet-our-team", name="meet-our-team")
     */
    public function teamAction()
    {
        return $this->render('layouts/meet-our-team.html.twig', [
        ]);
    }

    /**
     * @Route("/our-story", name="our-story")
     */
    public function storyAction()
    {
        return $this->render('layouts/our-story.html.twig', [
        ]);
    }

    /**
     * @Route("/donate", name="donate")
     */
    public function donateAction()
    {
        return $this->render('layouts/donate.html.twig', [
        ]);
    }

    /**
     * @Route("/gallery", name="gallery")
     */
    public function galleryAction()
    {
        return $this->render('links/gallery.html.twig', [
        ]);
    }

    /**
    * @Route("/upload", name="upload")
    */
    public function uploadAction(Request $request)
    {
        $file = new file();
        $form = $this->createForm(FileType::class, $file);

        $file->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($file);
            $em->flush();

            return $this->redirectToRoute('upload');
        }

        return $this->render('links/gallery.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
