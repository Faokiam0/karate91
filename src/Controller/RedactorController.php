<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\ChangePasswordType;

class RedactorController extends AbstractController
{
    
     public static function passwordValidator(String $str) : bool {
        //check longueur
        if (strlen($str) < 8 || strlen($str) >16)
            return false;
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $str); //check Majuscule
        $lowercase = preg_match('@[a-z]@', $str); //check Minuscule
        $number    = preg_match('@[0-9]@', $str); //check contient un numéro
        $specialChars = preg_match('@[^\w]@', $str); //check char spéciaux
        if(!$uppercase || !$lowercase || !$number || !$specialChars)
            return false;

        return true;
    }

    /**
     * @Route("/r3d4ct0r", name="redactor")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $nope = $this->passwordValidator("PASDEMINUS0");
        $yep = $this->passwordValidator("Valide.2020");


        $user =  $this->getUser();
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);
        $error=false;
        if($form->isSubmitted()){
            $data = $form->getData();
            $newpassword = $data['newpassword'];
            $newpassword2 = ($data['newpassword2'] == $data['newpassword']);
            $oldpassword = $encoder->isPasswordValid($user,$data['oldpassword']);

            if($form->isValid() && $oldpassword && $newpassword2 && $this->passwordValidator($newpassword)){
                $user->setPassword($encoder->encodePassword($user, $newpassword));
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();
                
                return $this->redirectToRoute('redactor');
            }
            else{
                if (!$this->passwordValidator($newpassword))
                    $error .= "Veuillez entrer un mot de passe entre 8 et 16 caractère.\n 
                    Ce mot de passe doit contenir aux moins 1 minuscule, 1 majuscule, 1 chiffre et un caractère spéciaux.\n ";
                if (!$newpassword2)
                    $error .= "Veulliez entrer 2 fois le même mot de passe.\n ";
                if (!$oldpassword)
                    $error .= "Veulliez entrer l'ancien mot de passe.";
            }

            
        }


        return $this->render('redactor/index.html.twig', [
            'controller_name' => 'RedactorController',
            'form' => $form->createView(),
            'error' => $error,
            'yep' => $yep,
            'nope' => $nope,
        ]);
    }
}
