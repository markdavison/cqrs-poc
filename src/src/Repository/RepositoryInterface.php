<?php

namespace App\Repository;

use App\Entity\EntityInterface;

/**
 * Core principle: Repository interface has no third-party dependencies.
 */
interface RepositoryInterface
{
    public function save(EntityInterface $entity);

    public function delete(EntityInterface $entity);

    // string for now for simplicity's sake (possibly Id object)
    public function find(string $id): EntityInterface;

    // arrays for now for simplicity's sake (Use a collection preferably)
    public function findBy(array $criteria): ?array;
}