<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    public function getArticles($sort, $needle = null)
    {
        if (!empty($needle)) {
            $dql = "SELECT a FROM {$this->getClassName()} as a WHERE a.title LIKE '%{$needle}%' OR a.content LIKE '%{$needle}%' ORDER BY a.id {$sort}";
        } else {
            $dql = "SELECT a FROM {$this->getClassName()} as a ORDER BY a.id {$sort}";
        }
        return $this->getEntityManager()->createQuery($dql)->getResult();
    }
}
