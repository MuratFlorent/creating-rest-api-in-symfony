<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPersonData extends Fixture
{
	public function load(ObjectManager $manager){

			$person = new person();
			$person->setFirstName('admin');
			$person->setLastName('admin');
			$person->setDateOfBirth(new \DateTime('1988-11-12'));

			$manager->persist($person);
			$manager->flush();
		}
}