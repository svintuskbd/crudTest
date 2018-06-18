<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 18.06.18
 * Time: 19:39
 */

namespace BlogBundle\Services;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;

/**
 * Class ArticleManagerService
 * @package BlogBundle\Services
 */
class ArticleManagerService
{
    /**
     * @var EntityManager $em
     */
    protected $em;

    /**
     * ArticleManagerService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function articleCreate(Article $article)
    {
        $this->em->persist($article);
        $this->em->flush();
    }
}