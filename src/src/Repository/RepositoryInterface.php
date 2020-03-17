<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function save(EntityInterface $entity);

    public function delete(EntityInterface $entity);

    public function find(string $id): EntityInterface;

    // arrays for now for simplicity's sake
    public function findBy(array $criteria): array;
}