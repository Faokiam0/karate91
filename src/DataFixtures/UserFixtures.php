<?php

namespace App\DataFixtures;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
     }

     public function load(ObjectManager $manager)
     {
         $user = new User();
         // ...
        $user->setEmail('csks91@gmail.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'Kata.2020'
        ));
        $array = ['ROLE_ADMIN'];
        $user->setRoles($array);

        $manager->persist($user);
        $manager->flush();
 
         // ...
     }
}
