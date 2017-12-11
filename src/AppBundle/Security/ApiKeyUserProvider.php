<?php
/**
 * Created by PhpStorm.
 * User: m.martin
 * Date: 11/12/2017
 * Time: 14:27
 */

namespace AppBundle\Security;


use AppBundle\Entity\Author;
use AppBundle\Repository\AuthorRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiKeyUserProvider implements UserProviderInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getUsernameForApiKey($apiKey)
    {
        /** @var AuthorRepository $repo */
        $username = $this->em->getRepository("AppBundle:Author")
            ->findOneBy(array(
                'apiKey' => $apiKey
            ))->getUsername();

        return $username;
    }

    public function loadUserByUsername($username)
    {
        /** @var AuthorRepository $repo */
        $user = $this->em->getRepository("AppBundle:Author")
            ->findOneBy(array('username' => $username));

        return new User($username, null, $user->getRoles());
    }

    public function refreshUser(UserInterface $user)
    {
        $authorId = $user->getId();

        /** @var AuthorRepository $repo */
        $author = $this->em->getRepository("AppBundle:Author")
            ->find($authorId);

        return $author;
    }

    public function supportsClass($class)
    {
        return Author::class === $class;
    }
}