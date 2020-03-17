<?php

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Entity\EventGeneratorTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * The base repository implementation is tied to the third-party
 * libs we choose to use via its constructor. Concrete implementations
 * have no third-party dependencies.
 */
abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var MessageBusInterface
     */
    private $dispatcher;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    protected $entityClass;

    public function __construct(
        MessageBusInterface $dispatcher,
        EntityManagerInterface $em,
        string $entityClass
    ) {
        $this->dispatcher = $dispatcher;
        $this->em = $em;
        $this->entityClass = $entityClass;
    }

    public function save(EntityInterface $entity)
    {
        $this->em->persist($entity);

        $this->dispatchEntityEvents($entity);

        $this->em->flush();
    }

    public function delete(EntityInterface $entity)
    {
        $this->em->remove($entity);

        $this->dispatchEntityEvents($entity);

        $this->em->flush();
    }

    public function find(string $id) :EntityInterface
    {
        return $this->em->find($this->entityClass, $id);
    }

    public function findBy(array $criteria): ?array
    {
        return $this->em->getRepository($this->entityClass)->findBy($criteria);
    }

    protected function dispatchEntityEvents(EntityInterface $entity)
    {
        foreach ($entity->popEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}