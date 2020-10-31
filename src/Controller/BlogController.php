<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BlogRepository;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blogList(BlogRepository $rep)
    {
        $array = $rep->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'blogs' => $array,
        ]);
    }

    /**
     * @Route("/blog/{slug}", name="blog_render",)
     */
    public function blogRender($slug,BlogRepository $rep) {
        $blog = $rep->findBySlug($slug);

        return $this->render('blog/blog.html.twig', [
            'controller_name' => 'BlogController',
            'blog' => $blog,
        ]);
    }
}
