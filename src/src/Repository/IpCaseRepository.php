<?php

namespace App\Repository;

use App\Entity\IpCase;

class IpCaseRepository extends BaseRepository
{
    public function __construct(
        MessageBusInterface $eventBus,
        EntityManagerInterface $em
    ) {
        parent::__construct($eventBus, $em, IpCase::class);
    }
}
