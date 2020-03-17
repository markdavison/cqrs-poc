<?php


namespace App\Entity;

use JMS\Serializer\Annotation\Exclude;
use App\DomainEvent\DomainEventInterface;

trait EventGeneratorTrait
{
    /**
     * @Exclude
     */
    protected $events = [];

    public function popEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    protected function raise(DomainEventInterface $event)
    {
        $this->events[] = $event;
    }

}