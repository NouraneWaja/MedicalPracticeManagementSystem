<?php

namespace App\DataFixtures;

use App\Entity\Analyse;
use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = \Faker\Factory::create();
        
       for($i=1;$i<=5;$i++)
        {
        //create 5 medicaments
        $patient=new Patient();
        $patient->setNom("Patient n° $i");
        $patient->setPrenom("Prenom du patient n° $i");
        $randomBirthDate = new DateTime();
    $randomBirthDate->modify("-" . rand(1, 80) . " years");
        $patient->setDateDeNaissance($randomBirthDate);
        $patient->setAdresse("Adresse n° $i");
        $patient->setNumTel($i);
        $manager->persist($patient);
        
        for($j=1;$j<=10;$j++)
        {
            
        $analyse=new Analyse();
        $analyse-> setNom("Patient n° $j");
        $analyse-> setType("Type n° $j");
        $randomDate = new DateTime();
        $randomDate->modify("-" . rand(1, 180) . " days");
        $analyse-> setDate($randomDate);
        $analyse-> addPatient($patient);
        $manager->persist($analyse);
        
        
        }
        }

        $manager->flush();
    }
}
