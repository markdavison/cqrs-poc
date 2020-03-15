<?php


namespace App\DomainEventListener;


use App\DomainEvent\IpCaseCreated;
use App\DomainEvent\IpCaseEventInterface;
use App\Message\SourceSubjectData;
use App\Repository\IpCaseRepository;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SourceSubjectDataListener implements MessageSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    private $asyncBus;

    public function __construct(
        MessageBusInterface $asyncBus
    ) {
        $this->asyncBus = $asyncBus;
    }

    public function __invoke(IpCaseEventInterface $event)
    {
        $ipCase = $event->getIpCase();

        $this->asyncBus->dispatch(new SourceSubjectData(
                $ipCase->getId(),
                $ipCase->getIpNumber(),
                $ipCase->getTerritoryCode())
        );
    }

    public static function getHandledMessages(): iterable
    {
        yield IpCaseCreated::class;
    }
}