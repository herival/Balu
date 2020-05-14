<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    /**
     * @Route("/footer/CGV", name="cgv")
     */
    public function cgv()
    {
        return $this->render('footer/cgv.html.twig', [
            'controller_name' => 'cgv',
        ]);
    }
        /**
     * @Route("/footer/cgu", name="cgu")
     */
    public function cgu()
    {
        return $this->render('footer/cgu.html.twig', [
            'controller_name' => 'cgu',
        ]);
    }
        /**
     * @Route("/footer/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('footer/contact.html.twig', [
            'controller_name' => 'contact',
        ]);
    }
        /**
     * @Route("/footer/mentionslegales", name="mentionslegales")
     */
    public function mentionslegales()
    {
        return $this->render('footer/mentionslegales.html.twig', [
            'controller_name' => 'mentionslegales',
        ]);
    }
}
