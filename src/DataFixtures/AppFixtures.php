<?php

namespace App\DataFixtures;

use App\Entity\Addresse;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class AppFixtures extends Fixture
{
    /**
     *$faker Faker\Factory
     */
    private $faker;
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->faker = Factory::create();
      //  $this->createAddresse($manager);
        $this->createClient($manager);
        $manager->flush();
    }
    public function createClient(ObjectManager $manager)
    {
        $sexeArr = ['m','f'];
        
        for ($i=0; $i < 20 ; $i++) { 
            $client = new Client();
            $addresse = $manager->find(Addresse::class,(2 + $i));
            $client->setNom($this->faker->name)
                    ->setSexe($sexeArr[random_int(0,1)])
                    ->setTelephone(substr($this->faker->e164PhoneNumber,0,10))
                    ->setMail($this->faker->email)
                    ->setIdAddress($addresse);
            $manager->persist($client);
        }
    }
    public function createAddresse(ObjectManager $manager)
    {
        for ($i=0; $i < 30 ; $i++) { 
            $addresse = new Addresse();
            $addresse->setVille($this->faker->city)
                     ->setCommune($this->faker->country)
                     ->setQuartier($this->faker->citySuffix)
                     ->setAvenue($this->faker->streetName)
                     ->setNumero(substr($this->faker->buildingNumber,0,3));
            $manager->persist($addresse);
        }
    }
}
