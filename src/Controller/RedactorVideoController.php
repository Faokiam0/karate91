<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoFormType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RedactorVideoController extends AbstractController
{
    /**
     * @Route("/r3d4ct0r/video", name="redactor_videos")
     */
    public function index(VideoRepository $rep)
    {
        //replace to find 0 to 10 and so on
        $videos = $rep->findAll();
        return $this->render('redactor/redactor_video.html.twig', [
            'controller_name' => 'RedactorVideoController',
            'videos' => $videos
        ]);
    }

    /**
     * @Route("/r3d4ct0r/video/delete-{id}", name="redactor_videos_delete")
     */
    public function deleteVideo(VideoRepository $rep, $id)
    {
        $video = $rep->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($video);
        $manager->flush();

        $this->addFlash(
            'danger',
            'La vidéo a bien été supprimée'
        );

        return $this->redirectToRoute('redactor_videos');
    }

    /**
     * @Route("/r3d4ct0r/video/create", name="redactor_videos_create")
     */
    public function createVideo(Request $request)
    {
        $video = new Video();

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            if($form->isValid()){
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($video);
                $manager->flush();
                $this->addFlash(
                    'success',
                    'La vidéo a bien été ajoutée'
                );
            }
            else{
                $this->addFlash(
                    'danger',
                    'Une erreur est survenue'
                );
            }

            return $this->redirectToRoute('redactor_videos');
        }

        return $this->render('redactor/redactor_form.html.twig', [
            'form' => $form->createView(),
            'formName' => 'Ajouter une vidéo youtube'
        ]);
    }

    /**
     * @Route("/r3d4ct0r/video/update-{id}", name="redactor_videos_update")
     */
    public function updateVideo(VideoRepository $rep, $id, Request $request)
    {
        $video = $rep->find($id);

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($video);
            $manager->flush();
            $this->addFlash(
                'success',
                'La vidéo a bien été modifiée'
            );
            return $this->redirectToRoute('redactor_videos');
        }

        return $this->render('redactor/redactor_form.html.twig', [
            'form' => $form->createView(),
            'formName' => 'Modifier une vidéo youtube'
        ]);
    }
}
