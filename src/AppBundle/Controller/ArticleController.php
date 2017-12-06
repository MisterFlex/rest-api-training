<?php
/**
 * Created by PhpStorm.
 * User: m.martin
 * Date: 06/12/2017
 * Time: 16:27
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;

class ArticleController extends Controller
{
    /**
     * @Rest\Get(
     *     path="/articles",
     *     name="article_list_all"
     * )
     * @Rest\View
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("AppBundle:Article");
        $articles = $repo->findAll();

        return $articles;
    }
}