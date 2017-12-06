<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $author1 = new Author();
        $author1->setFirstName("Ghost");
        $author1->setLastName("Dark");
        $author1->setProfession("Web Developper");
        $this->addReference("author1", $author1);
        $manager->persist($author1);

        $author2 = new Author();
        $author2->setFirstName("Tiffa");
        $author2->setLastName("Caet");
        $author2->setProfession("Social worker");
        $this->addReference("author2", $author2);
        $manager->persist($author2);

        $manager->flush();
    }
}