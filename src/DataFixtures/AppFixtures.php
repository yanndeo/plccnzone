<?php

namespace App\DataFixtures;
use Cocur\Slugify\Slugify;

use App\Entity\Category;
use App\Entity\Fabricant;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{


    public function randomElements($tabElements) {

        $nb_items = mt_rand(0, (count($tabElements) -1));

        if($nb_items > 0){
            $rand_keys = array_rand($tabElements, $nb_items);
            return $rand_keys;

        }

        return 0;

    }



    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_BE');

        for($c=0; $c <= 8 ; $c++){
            $category = new Category();
            $category->setName($faker->colorName)
                     ->setDescription($faker->text($maxNbChars = 100));
            $manager->persist($category);
            $manager->flush();
        }


        for($f = 0 ; $f <= 20 ; $f++){ 

            $fabricant = new Fabricant();
            $fabricant->setName($faker->name)
                      ->setDescription($faker->sentence($nbWords = 24, $variableNbWords = true));

            $categories = $manager->getRepository(Category::class)->findAll();
            $keys = $this->randomElements($categories);
            //var_dump($keys);die();
                if(is_array($keys) && count($keys) > 1){
                    foreach ($keys as $k) {
                        $fabricant->addCategory($categories[$k]);
                    }
                }else{
                    $fabricant->addCategory($categories[$keys]);
                }
                
            $manager->persist($fabricant);

            for($p = 0 ; $p < mt_rand(3, 50); $p ++){ 

                $product = new Product();
                $product->setLibelle($faker->jobTitle)
                        ->setDescription($faker->sentences($bn = 8, $asText = true))
                        ->setReference($faker->vat(false))
                        ->setCreatedAt($faker->dateTimeBetween('-3 months'))
                        ->setFabricant($fabricant);

                $categories = $manager->getRepository(Category::class)->findAll();
                $keys = $this->randomElements($categories);
                //var_dump($keys);die();
                if (is_array($keys) && count($keys) > 1) {
                    foreach ($keys as $k) {
                        $product->addCategory($categories[$k]);
                    }
                } else {
                    $product->addCategory($categories[$keys]);
                }

                $manager->persist($product);   

            };

        };


        $manager->flush();
       




       

        

          

        
    }
}
