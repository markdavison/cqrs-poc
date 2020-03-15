<?php


namespace App\DomainEventListener;


use App\Command\SourceSubjectDataCommand;
use App\DomainEvent\IpCaseCreated;
use App\DomainEvent\IpCaseEventInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SourceSubjectDataListener implements MessageSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    private $asyncCommandBus;

    public function __construct(MessageBusInterface $asyncCommandBus) {
        $this->asyncCommandBus = $asyncCommandBus;
    }

    public function __invoke(IpCaseEventInterface $event)
    {
        $ipCase = $event->getIpCase();

        $this->asyncCommandBus->dispatch(
            new SourceSubjectDataCommand(
                $ipCase->getId(),
                $ipCase->getIpNumber(),
                $ipCase->getTerritoryCode()
            )
        );
    }

    public static function getHandledMessages(): iterable
    {
        yield IpCaseCreated::class;
    }
}