<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime("now");
        $limit = 10;

        for ($i = 0; $i <= $limit; $i++) {
            $article = new Article();
            $article->setTitle("Article {$i}");
            $article->setContent("Article {$i}");
            $article->setCreateDate($date->add(new \DateInterval("P{$i}D")));
            if ($i < 7) {
                $article->setAuthor($this->getReference("author1"));
            } else {
                $article->setAuthor($this->getReference("author2"));
            }

            $manager->persist($article);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AuthorFixtures::class
        ];
    }
}