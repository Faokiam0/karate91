<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Blog;
use App\Entity\Partner;
use App\Entity\Video;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        //Blog
        $blog = new Blog();
        $blog->setTitle("Le titre du premier blog");
        $blog->setContent("<h2>Contenu en taille h2</h2>");
        $blog->setDate(new \DateTime('NOW'));
        //Video
        $video = new Video();
        $video->setDate(new \DateTime('NOW'));
        $video->setLink("www.youtube.com");
        $video->setDescription('Description de vidéos');
        $video->setTitle('Titre de vidéo');
        //Partner
        $partner = new Partner();
        $partner->setName("Fak shop");
        $partner->setLink("www.fak.com");
        $partner->setIcon("fak-icon");


        $manager->persist($blog);
        $manager->persist($video);
        $manager->persist($partner);
        $manager->flush();
    }
}
