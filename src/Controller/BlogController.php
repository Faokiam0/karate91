<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blogList()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/blog/{slug}", name="blog_render",)
     */
    public function blogRender(BlogRepository $rep,$slug) {
        $blog = $rep->findBySlug($slug);

        return $this->render('blog/blog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
