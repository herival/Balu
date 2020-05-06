<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageTestController extends AbstractController
{
    /**
     * @Route("/page/test", name="page_test")
     */
    public function index()
    {
        return $this->render('page_test/index.html.twig', [
            'controller_name' => 'PageTestController',
        ]);
    }
}
