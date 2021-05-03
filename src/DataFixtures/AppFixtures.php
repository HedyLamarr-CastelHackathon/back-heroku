<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

     

        $users = [
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Cyril',
            'lastname' => 'Vassallo',
            'age' => 37,
            'job' => 'développeur web backend',
            'description' => 'Développeur Fullstack php/javascript. Je participe Hakathon en temps que développeur backend dans l\'équipe HedyLamarr',
            'email' =>  'cyrilvssll34@gmail.com',
            'birthday' => '19 Juillet',
            'gitHub' => 'https://github.com/cyril-vassallo'
            ],
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Younes ',
            'lastname' => ' Boukobaa',
            'age' => 35,
            'job' => 'développeur web backend',
            'description' => 'J\'exel dans le développement de site de commerce. Je serait le second développeur backend de l\'équipe',
            'email' =>  'younes-b@gmail.com',
            'birthday' => '14 avril',
            'gitHub' => ''
            ],
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Benjamin',
            'lastname' => ' Cloquet',
            'age' => 24,
            'job' => 'développeur web frontend',
            'description' => 'Ex développeur de jeux vidéo Chez Ubi. Je me spécialise en Javascript. Je serai le lead développer React de l\'équipe HedyLamarr',
            'email' =>  'ben-cloquet@gmail.com',
            'birthday' => '24 Janvier',
            'gitHub' => ''
            ],
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Vincent ',
            'lastname' => ' Landrieux',
            'age' => 28,
            'job' => 'développeur web frontend',
            'description' => 'Je débute en React mais pas en Js. Je viens renforcer notre lead front',
            'email' =>  'ben-cloquet@gmail.com',
            'birthday' => '24 Janvier',
            'gitHub' => ''
            ]
        ];

        foreach($users as $key  => $value ){
            $user = new User();
            $user->setFirstname($users[$key]['firstname'])
                 ->setLastname($users[$key]['lastname'])
                 ->setAge($users[$key]['age'])
                 ->setJob($users[$key]['job'])
                 ->setDescription($users[$key]['description'])
                 ->setEmail($users[$key]['email'])
                 ->setBirthday($users[$key]['birthday'])
                 ->setRole($users[$key]['role'])
                 ->setGitHub($users[$key]['gitHub']);   
            $manager->persist($user);
        }
        $manager->flush();
    }
}
