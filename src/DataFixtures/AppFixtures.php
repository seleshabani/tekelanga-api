<?php

namespace App\DataFixtures;

use App\Entity\Addresse;
use App\Entity\Agent;
use App\Entity\Categories;
use App\Entity\Client;
use App\Entity\Images;
use App\Entity\Produit;
use App\Entity\Stock;
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
        //$this->createClient($manager);
        //$this->createAgent($manager);
        //$this->createCategories($manager);
        $this->createImages($manager);
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
    public function createAgent(ObjectManager $manager)
    {
        $sexeArr = ['m','f'];
        
        for ($i=0; $i < 20 ; $i++) { 
            $agent = new Agent();
            $addresse = $manager->find(Addresse::class,(2 + $i));
            $agent->setNom($this->faker->name)
                    ->setSexe($sexeArr[random_int(0,1)])
                    ->setTelephone(substr($this->faker->e164PhoneNumber,0,10))
                    ->setMail($this->faker->email)
                    ->setIdAddress($addresse);
            $manager->persist($agent);
        }
    }
    public function createCategories(ObjectManager $manager)
    {
        $categories = ["alimentaire","menager","enfants"];
        for ($i=0; $i < count($categories) ; $i++) { 
            $categorie = new Categories();
            $categorie->setNom($categories[$i]);
            $manager->persist($categorie);
        }
    }
    public function createProduit(ObjectManager $manager)
    {
        $produitsData = require "produitsData.php";
        $catRepo = $manager->getRepository(Categories::class);

        foreach ($produitsData as $key => $value) {
            $categorie = $catRepo->findOneByname($key);

            for ($i=0; $i < count($value) ; $i++) { 
                $produit = new Produit();
                $produit->setNom($value[$i])
                        ->setIdCategories($categorie);
                $manager->persist($produit);
            }
        }
    }
    public function createStock(ObjectManager $manager)
    {
        $prodRepo = $manager->getRepository(Produit::class);
        $produits = $prodRepo->findAll();

        for ($i=0; $i < count($produits) ; $i++) { 
            $stock = new Stock();
            $stock->setIdProduit($produits[$i])
                  ->setPrixUnitaire(random_int(500,100000))
                  ->setQuantite(random_int(1,50))
                  ->setPrixTotal($stock->getPrixUnitaire() * $stock->getQuantite());
            $manager->persist($stock);
        }
    }
    public function createImages(ObjectManager $manager)
    {
        for ($i=1; $i <= 15; $i++) { 
            $produit = $manager->find(Produit::class,$i);
            $image = new Images();
            $image->setLabel("")
                  ->setLocation($this->faker->imageUrl(224,173))
                  ->setIdProduit($produit);
            $manager->persist($image);
        }
    }
}
