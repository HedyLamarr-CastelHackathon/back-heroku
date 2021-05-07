<?php

namespace App\DataFixtures;

use App\Entity\Geo;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Wish;
use App\Entity\Report;
use App\Entity\Garbage;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{

    //injected Dependencies
    private $manager;
    private $log;

    //Class properties
    private $saveType;
    private $types;
    private $garbages;


    public function __construct(LoggerInterface $log)
    {
        $this->saveType = [];
        $this->types = ['C1', 'C2', 'C3'];
        $this->log = $log;
        $this->garbages = [];
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->insertUsers()
            ->insertTypes()
            ->insertGarbages()
            ->insertWishes()
            ->insertReports();
    }


    /**
     * Insert Users
     *
     * @return $this
     */
    private function insertUsers()
    {
        $users = json_decode(file_get_contents(__DIR__ . '/users.json', true));

        $this->log->info(json_encode($users, true));

        foreach ($users as $key  => $value) {
            $user = new User();
            $this->log->info(json_encode($users[$key]->role, true));
            $user->setFirstname($users[$key]->firstname)
                ->setLastname($users[$key]->lastname)
                ->setAge($users[$key]->age)
                ->setJob($users[$key]->job)
                ->setDescription($users[$key]->description)
                ->setEmail($users[$key]->email)
                ->setBirthday($users[$key]->birthday)
                ->setRole($users[$key]->role)
                ->setGitHub($users[$key]->gitHub);
            $this->manager->persist($user);
        }


        $this->manager->flush();
        return $this;
    }

    /**
     * Insert Types
     *
     * @return $this
     */
    private function insertTypes()
    {

        foreach ($this->types as $value) {
            $type = new Type();
            $type->setCode($value);
            $this->manager->persist($type);
            $this->saveType[] = $type;
        }
        $this->manager->flush();

        return $this;
    }

    /**
     * Insert all Garbages
     *
     * @return $this
     */
    private function insertGarbages()
    {

        $data = json_decode(file_get_contents(__DIR__ . '/data.json', true));

        foreach ($data as $key => $values) {

            $l =  $values->fields->geo_point_2d;
            $localisation = json_encode($l);
            // $types = $values->fields->code_corbe;

            $geo = new Geo();
            $geo->setLocalisation($localisation);

            $garbage = new Garbage();
            $garbage->setGeo($geo)
                ->setType($this->saveType[rand(0, 2)])
                ->setIsActive(1);

            array_push($this->garbages, $garbage);
            $geo->addGarbage($garbage);

            $this->manager->persist($geo);
            $this->manager->persist($garbage);

            if ($key == 100) {
                break;
            }
        }

        $this->manager->flush();

        return $this;
    }

    /**
     * Insert some Wishes
     *
     * @return $this
     */
    private function insertWishes(){

        for($w = 0 ; $w < 15; $w++ ){
            $wish = new Wish();
            $geo = new Geo();

            $localisation =  '{ 47.74868898'.rand(10, 99).',7.334292850'.rand(10, 99) .'}';
            $this->log->info($localisation);
            $geo->setLocalisation($localisation);
            $this->manager->persist($geo);
            
            $wish->setType($this->saveType[rand(0, 2)])
                 ->setGeo($geo);

            $this->manager->persist($wish);
        }
        $this->manager->flush();
        return $this;
    }

    /**
     * Insert some reports
     *
     * @return $this
     */
    private function insertReports(){
  
  
        for($g = 0 ; $g < 3 ; $g++){
            $report = new Report();
            $report->setGarbage($this->garbages[rand(0,100)])
                   ->setIsFull(rand(0,1))
                   ->setIsHere(1)
                   ->setIsDamaged(rand(0,1));
            $this->manager->persist($report);   
        }

        return $this;
    }
}
