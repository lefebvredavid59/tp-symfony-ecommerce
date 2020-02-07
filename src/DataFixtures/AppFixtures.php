<?php


namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;


class AppFixtures extends Fixture
{
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 1;$i <= 100; ++$i){
            $product = new Product();
            $product->setName('iPhone '.$i);
            $product->setCouleurs(['Rouge', 'Argent', 'Noir']);
            $product->setDate($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now'));
            $product->setDescription('Un iPhone de '.(rand(2000,2200)));
            $product->setCoeur($faker->boolean(10));
            $product->setSlug($this->slugger->slug($product->getName())->lower());
            $product->setPrix(rand(10,1000)*100);
            $manager->persist($product);
        }

        $manager->flush();
    }
}