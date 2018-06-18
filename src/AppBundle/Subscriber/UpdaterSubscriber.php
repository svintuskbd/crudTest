<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 18.06.18
 * Time: 20:06
 */

namespace AppBundle\Subscriber;


use AppBundle\Entity\Article;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class UpdaterSubscriber implements EventSubscriber
{
    /**
     * var Logger
     */
    private $logger;

    /** @var TokenStorage $tokenStorage */
    private $tokenStorage;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Constructor
     *
     * @param TokenStorage $tokenStorage
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(TokenStorage $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $entityManager;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'postPersist',
            'preUpdate',
            'postUpdate',

        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (
            method_exists($entity, 'setUpdatedAt')
        ) {
            $entity->setUpdatedAt(new \DateTime('now'));
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (
            method_exists($entity, 'setCreatedAt')
            &&
            method_exists($entity, 'setUpdatedAt')
        ) {
            $entity->setCreatedAt(new \DateTime('now'));
            $entity->setUpdatedAt(new \DateTime('now'));
        }
    }
}