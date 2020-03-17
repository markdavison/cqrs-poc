<?php

namespace App\Repository;

use App\Controller\BaseController;
use App\Entity\Subject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class SubjectRepository
 * @package App\Repository
 */
class SubjectRepository extends BaseRepository
{

    public function __construct(
        MessageBusInterface $eventBus,
        EntityManagerInterface $em
    ) {
        parent::__construct($eventBus, $em, Subject::class);
    }
}
