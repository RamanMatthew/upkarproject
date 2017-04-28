<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Relative;
use AppBundle\Entity\Student;
use AppBundle\Form\RelativeType;

class RelativesController extends Controller
{
    /**
    * @Route("/students/{id}/relatives/create", name="relative-create")
    */

    public function createAction(Request $request, Student $student)
    {
        $relative = new Relative();
        $form = $this->createForm(RelativeType::class, $relative);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $student->addRelative($relative);

            $em->flush();

            return $this->redirectToRoute('student-show', ['id' => $student->getId()]);
        }

        return $this->render('relatives/create.html.twig', [
            'form' => $form->createView(),
            'student' => $student
        ]);
    }
    /**
    * @Route("/students/{student_id}/relatives/{relative_id}/edit", name="relative-edit")
    */
    public function editAction(Request $request, $student_id, $relative_id)
    {
        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        $relative = $em->getRepository('AppBundle:Relative')->find($relative_id);

        $form = $this->createForm(RelativeType::class, $relative);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($request->request->get('delete')) {
                $em->remove($relative);
                $em->flush();

                return $this->redirectToRoute('relative-edit');
            } elseif ($form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('student-show', ['id' => $student->getId()]);
            }
        }

        return $this->render('relatives/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
