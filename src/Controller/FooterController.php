<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $formContact = $this->createForm(ContactType::class);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid()){
            $contact = $formContact->getData();
            // dd($contact);
            $message = (new \Swift_Message('Nouveau Contact'))
                ->setFrom($contact['email'])
                ->setTo('herimalala.val@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);

            $this->addFlash('success', 'Le message à bien été envoyé');


            return $this->redirectToRoute('contact');
        }

        return $this->render('footer/contact.html.twig', [
            'formContact' => $formContact->createView()
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
