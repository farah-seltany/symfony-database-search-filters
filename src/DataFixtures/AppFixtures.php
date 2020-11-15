<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);

        for ($c=0; $c < 5; $c++) {
            $category = new Category();
            $category->setTitle($faker->word);

            $manager->persist($category);

            for ($p=0; $p < mt_rand(3, 10); $p++) {
                $product = new Product();
                $product->setTitle($faker->word);
                $product->setPrice($faker->randomFloat(2, 5, 100));
                $product->setDescription($faker->paragraph);
                $product->setCategory($category);

                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}
