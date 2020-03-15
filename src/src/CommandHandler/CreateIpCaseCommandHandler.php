<?php


namespace App\CommandHandler;


use App\Command\CreateIpCaseCommand;
use App\Entity\IpCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateIpCaseCommandHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MessageBusInterface
     */
    private $eventBus;


    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $eventBus)
    {
        $this->entityManager = $entityManager;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateIpCaseCommand $command)
    {
        $ipCase = new IpCase(
            $command->getId(),
            $command->getIpNumber(),
            $command->getTerritoryCode(),
            $command->getCaseReference()
        );

        $this->entityManager->persist($ipCase);
        $this->entityManager->flush();

        foreach ($ipCase->popEvents() as $event) {
            $this->eventBus->dispatch($event);
        }
    }
}