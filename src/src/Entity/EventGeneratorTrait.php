<?php


namespace App\Entity;


use App\DomainEvent\DomainEventInterface;

trait EventGeneratorTrait
{
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