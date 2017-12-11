<?php
/**
 * Created by PhpStorm.
 * User: m.martin
 * Date: 06/12/2017
 * Time: 16:27
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Repository\ArticleRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;

class ArticleController extends FOSRestController
{
    /**
     * @Rest\Get(
     *     path="/api/articles",
     *     name="article_list_all"
     * )
     * @QueryParam(
     *     name="sort",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     *
     * @Rest\View
     */
    public function listAction($sort)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var ArticleRepository $repo */
        $repo = $em->getRepository("AppBundle:Article");
        $articles = $repo->getArticles($sort);

        return $articles;
    }

    /**
     * @Rest\Post(
     *     path="/api/articles",
     *     name="filter_articles"
     * )
     * @QueryParam(
     *     name="sort",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     *
     * @RequestParam(
     *     name="needle",
     *     requirements="[a-zA-Z0-9]",
     *     default=null,
     *     nullable=true,
     *     description="Search query to look for articles"
     * )
     *
     * @Rest\View
     */
    public function searchAction($sort, $needle)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var ArticleRepository $repo */
        $repo = $em->getRepository("AppBundle:Article");
        $articles = $repo->getArticles($sort, $needle);

        return $articles;
    }

    /**
     * @Rest\Get(
     *     path ="/article/{id}/show",
     *     name="article_show",
     *     requirements = {"id" = "\d+"}
     * )
     * @Rest\View
     */
    public function showArticle(Article $article)
    {
        return $article;
    }

    /**
     * @Rest\Post(
     *     path ="/article",
     *     name="article_create_new",
     *     requirements= {
     *         "id" = "\d+"
     *     }
     * )
     *
     * @Rest\View(
     *     StatusCode=201
     * )
     *
     * @ParamConverter("article", converter="fos_rest.request_body")
     */
    public function createArticle(Article $article, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("AppBundle:Author");
        $author = $repo->find($id);

        if (!$author) {

        }

        $article->setAuthor($author);
        $em->persist($article);
        $em->flush();

        return $this->view($article, Response::HTTP_CREATED, [
            'Location' => $this->generateUrl("article_show", [
                'id' => $article->getId(),
                UrlGeneratorInterface::ABSOLUTE_URL
            ])
        ]);

    }

    /**
     * @Rest\Put(
     *     path ="/article/{id}/edit",
     *     name="article_edit",
     *     requirements = {"id" = "\d+"}
     * )
     * @Rest\View
     * @ParamConverter("article", converter="fos_rest.request_body")
     */
    public function editArticle(Article $article)
    {

    }

    /**
     * @Rest\Delete(
     *     path ="/article/{id}/delete",
     *     name="article_delete",
     *     requirements = {"id" = "\d+"}
     * )
     * @Rest\View
     * @ParamConverter("article", converter="fos_rest.request_body")
     */
    public function removeArticle(Article $article)
    {

    }

}