<?php

namespace App\Repository;

use App\Entity\IpCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class IpCaseRepository extends BaseRepository
{
    public function __construct(
        MessageBusInterface $dispatcher,
        EntityManagerInterface $em
    ) {
        parent::__construct($dispatcher, $em, IpCase::class);
    }
}
