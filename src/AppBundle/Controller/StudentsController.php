<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Student;
use AppBundle\Entity\Relative;
use AppBundle\Form\StudentType;

/**
* @Security("is_granted('ROLE_USER')")
*/
class StudentsController extends Controller
{
    /**
    * @Route("/students", name="student-index")
    */
    public function indexAction()
    {

        $students = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Student')
        ->findAll();
            return $this->render('students/index.html.twig', compact('students'));
    }

    /**
    * @Route("/students/create", name="student-create")
    */
    public function createAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('student-index');
        }

        return $this->render('students/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/students/{id}", name="student-show")
    */
    public function showAction(Student $student)
    {
        $form = $this->createForm(StudentType::class, $student);
        return $this->render('students/show.html.twig', [
            'student' => $student,
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/students/{id}/edit", name="student-edit")
    */
    public function editAction(Request $request, Student $student)
    {
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            if ($request->request->get('delete')) {
                $em->remove($student);
                $em->flush();

                return $this->redirectToRoute('student-show');
            } elseif ($form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('student-show', ['id' => $student->getId()]);
            }
        }

        return $this->render('students/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
