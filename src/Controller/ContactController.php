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
    public function contact(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            if($form->isValid()){
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($contact);
                $manager->flush();
                $this->addFlash(
                    'success',
                    'Le partenaire a bien été ajouté'
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
