<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            if($form->isValid()){
                $contactFormData = $form->getData();
                $message = (new \Swift_Message($contactFormData['email']." a envoyez ce message"))
                ->setFrom('faokiam@gmail.com')
                ->setTo('fakum.baccam@gmail.com')
                ->setBody($contactFormData['message'],
                 'text/plain'
                );

                $mailer->send($message);
                $this->addFlash(
                    'success',
                    'Nous avons reçu votre message'
                );
            }
            else{
                $this->addFlash(
                    'danger',
                    'Une erreur est survenue'
                );
            }

            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'formName' => 'Formulaire de contact',
            'controller_name' => 'ContactController',
        ]);
    }
    
}
