<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerFormType;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RedactorPartnerController extends AbstractController
{
    /**
     * @Route("/r3d4ct0r/partner", name="redactor_partners")
     */
    public function index(PartnerRepository $rep)
    {
        //replace to find 0 to 10 and so on
        $partners = $rep->findAll();
        return $this->render('redactor/partner/index.html.twig', [
            'controller_name' => 'RedactorPartnerController',
            'partners' => $partners
        ]);
    }

    /**
     * @Route("/r3d4ct0r/partner/delete-{id}", name="redactor_partners_delete")
     */
    public function deletePartner(PartnerRepository $rep, $id)
    {
        $partner = $rep->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($partner);
        $manager->flush();

        $this->addFlash(
            'danger',
            'Le partenaire a bien été supprimé'
        );

        return $this->redirectToRoute('redactor_partners');
    }

    /**
     * @Route("/r3d4ct0r/partner/create", name="redactor_partners_create")
     */
    public function createPartner(Request $request)
    {
        $partner = new Partner();

        $form = $this->createForm(PartnerFormType::class, $partner);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            if($form->isValid()){
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($partner);
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

            return $this->redirectToRoute('redactor_partners');
        }

        return $this->render('redactor/partner/PartnerForm.html.twig', [
            'formPartner' => $form->createView()
        ]);
    }

    /**
     * @Route("/r3d4ct0r/partner/update-{id}", name="redactor_partners_update")
     */
    public function updatePartner(PartnerRepository $rep, $id, Request $request)
    {
        $partner = $rep->find($id);

        $form = $this->createForm(PartnerFormType::class, $partner);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($partner);
            $manager->flush();
            $this->addFlash(
                'success',
                'Le partenaire a bien été modifié'
            );
            return $this->redirectToRoute('redactor_partners');
        }

        return $this->render('redactor/partner/PartnerForm.html.twig', [
            'formPartner' => $form->createView()
        ]);
    }
}
