<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogFormType;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RedactorBlogController extends AbstractController
{
    /**
     * @Route("/r3d4ct0r/blog", name="redactor_blogs")
     */
    public function index(BlogRepository $rep)
    {
        //replace to find 0 to 10 and so on
        $blog = $rep->findBy(array(), array('id'=>'DESC'));
        return $this->render('redactor/redactor_blog.html.twig', [
            'controller_name' => 'RedactorBlogController',
            'blog' => $blog
        ]);
    }

    /**
     * @Route("/r3d4ct0r/blog/delete-{id}", name="redactor_blogs_delete")
     */
    public function deleteBlog(BlogRepository $rep, $id)
    {
        $blog = $rep->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($blog);
        $manager->flush();

        $this->addFlash(
            'danger',
            'L\'article a bien été supprimé'
        );

        return $this->redirectToRoute('redactor_blogs');
    }

    /**
     * @Route("/r3d4ct0r/blog/create", name="redactor_blogs_create")
     */
    public function createblog(Request $request)
    {
        $blog = new Blog();
        $now = new \DateTime(null, new \DateTimeZone('Europe/Paris'));
        $blog->setDate($now);
        $form = $this->createForm(BlogFormType::class, $blog);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            if($form->isValid()){
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($blog);
                $manager->flush();
                $this->addFlash(
                    'success',
                    'L\'article a bien été ajouté'
                );
            }
            else{
                $this->addFlash(
                    'danger',
                    'Une erreur est survenue'
                );
            }

            return $this->redirectToRoute('redactor_blogs');
        }

        return $this->render('redactor/redactor_blog_form.html.twig', [
            'form' => $form->createView(),
            'formName' => 'Ajouter un article'
        ]);
    }

    /**
     * @Route("/r3d4ct0r/blog/update-{id}", name="redactor_blogs_update")
     */
    public function updateBlog(BlogRepository $rep, $id, Request $request)
    {
        $blog = $rep->find($id);

        $form = $this->createForm(BlogFormType::class, $blog);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blog);
            $manager->flush();
            $this->addFlash(
                'success',
                'L\'article a bien été modifiée'
            );
            return $this->redirectToRoute('redactor_blogs');
        }

        return $this->render('redactor/redactor_blog_form.html.twig', [
            'form' => $form->createView(),
            'formName' => 'Modifier un article'
        ]);
    }
}
