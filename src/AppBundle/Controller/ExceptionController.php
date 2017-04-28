<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Exception\FlattenException;

class ExceptionController extends Controller
{
    /**
    * @Route("/error")
    */
    public function showExceptionAction(FlattenException $exception)
    {
        $code = $exception->getStatusCode();
        $message = $exception->getMessage();

        return $this->render('exceptions/show.html.twig', compact('code', 'message'));
    }
}
