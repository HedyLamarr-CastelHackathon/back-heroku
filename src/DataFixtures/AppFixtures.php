<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $user = new User();

        $users = [
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Cyril',
            'lastname' => 'Vassallo',
            'age' => 37,
            'job' => 'développeur web backend',
            'description' => 'Développeur Fullstack php/javascript. Je participe Hakathon en temps que développeur backend dans l\'équipe HedyLamarr',
            'email' =>  'cyrilvssll34@gmail.com',
            'birthday' => '19 Juillet'
            ],
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Younes ',
            'lastname' => ' Boukobaa',
            'age' => 35,
            'job' => 'développeur web backend',
            'description' => 'J\'exel dans le développement de site de commerce. Je serait le second développeur backend de l\'équipe',
            'email' =>  'younes-b@gmail.com',
            'birthday' => '14 avril'
            ],
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Benjamin',
            'lastname' => ' Cloquet',
            'age' => 24,
            'job' => 'développeur web frontend',
            'description' => 'Ex développeur de jeux vidéo Chez Ubi, Je me spécialise en Javascript. Je serais le lead développer  React de l\'équipe HedyLamarr',
            'email' =>  'ben-cloquet@gmail.com',
            'birthday' => '24 Janvier'
            ],
            [
            'role' => 'ROLE_ADMIN',
            'firstname' => 'Vincent ',
            'lastname' => ' Landrieux',
            'age' => 28,
            'job' => 'développeur web frontend',
            'description' => 'Je débute en React mais pas en Js. Je renforcerais notre lead dev front durant l',
            'email' =>  'ben-cloquet@gmail.com',
            'birthday' => '24 Janvier'
            ]
        ];

        for($u = 0; $u < count($users) ;  $u++ ){
            $user->setFirstname($users[$u]['firstname'])
                 ->setLastname($users[$u]['lastname'])
                 ->setAge($users[$u]['age'])
                 ->setJob($users[$u]['job'])
                 ->setDescription($users[$u]['description'])
                 ->setEmail($users[$u]['email'])
                 ->setBirthday($users[$u]['birthday'])
                 ->setRole($users[$u]['role'])
                 ->setGitHub($users[$u]['role']);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
