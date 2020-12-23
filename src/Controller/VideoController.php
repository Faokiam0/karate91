<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VideoRepository;

class VideoController extends AbstractController
{
    /**
     * @Route("/video/", name="video")
     */
    public function videoList(VideoRepository $rep, $max = 0)
    {
        if (is_null($max))
            $max = 0;
        $array = $rep->findBy(array(), array('id'=>'DESC'), 20, $max);

        return $this->render('video/index.html.twig', [
            'controller_name' => 'videoController',
            'videos' => $array,
            'max' => $max,
        ]);
    }

    /**
     * @Route("/video/{slug}", name="video_render")
     */
    public function videoRender($slug,VideoRepository $rep) {
        $video = $rep->findBySlug($slug);

        return $this->render('video/video.html.twig', [
            'controller_name' => 'videoController',
            'video' => $video,
        ]);
    }
}
