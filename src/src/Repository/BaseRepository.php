<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class BaseRepository implements RepositoryInterface
{
    private $eventBus;

    private $em;

    private $entityClass;

    public function __construct(
        MessageBusInterface $eventBus,
        EntityManagerInterface $em,
        string $entityClass
    ) {
        $this->eventBus = $eventBus;
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

    public function find(string $id)
    {
        return $this->em->find($this->entityClass, $id);
    }

    // arrays for now for simplicity's sake
    public function findBy(array $criteria): ?array
    {
        return $this->em->getRepository($entityClass)->findBy($criteria);
    }

    protected function dispatchEntityEvents(EntityInterface $entity)
    {
        foreach ($entity->popEvents() as $event) {
            $this->eventBus->dispatch($event);
        }
    }
}