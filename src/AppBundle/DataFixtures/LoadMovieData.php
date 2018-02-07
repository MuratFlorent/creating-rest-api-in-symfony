<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMovieData extends Fixture
{
	public function load(ObjectManager $manager){

		for($i=0;$i<5;$i++)
		{
			$movie1 = new movie();
			$movie1->setTitle('movie'.$i);
			$movie1->setYear(rand(1976,2005));
			$movie1->setTime(rand(167,205));

			$movie1->setDescription('Just a movie descritpion'.$i);

			$manager->persist($movie1);
			$manager->flush();
		}
	}

}