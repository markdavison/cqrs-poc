<?php


namespace App\DomainEventListener;


use App\DomainEvent\IpCaseCreated;
use App\DomainEvent\IpCaseEventInterface;
use App\DomainEvent\SubjectCreated;
use App\Entity\Subject;
use App\Message\SourceSubjectData;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;

class FrontendDispatcherListener implements MessageSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    private $eventBus;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        MessageBusInterface $eventBus,
        RouterInterface $router,
        SerializerInterface $serializer
    ) {
        $this->eventBus = $eventBus;
        $this->router = $router;
        $this->serializer = $serializer;
    }

    public function __invoke(IpCaseEventInterface $event)
    {
        $ipCase = $event->getIpCase();

        $this->eventBus->dispatch(new Update(
            $this->router->generate('get-ip_case', ['id' => $ipCase->getId()]),
            $this->serializer->serialize($ipCase, 'json')
        ));
    }

    public static function getHandledMessages(): iterable
    {
        yield SubjectCreated::class;
    }
}