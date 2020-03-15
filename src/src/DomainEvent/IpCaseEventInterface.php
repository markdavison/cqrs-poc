<?php


namespace App\DomainEvent;


use App\Entity\IpCase;

interface IpCaseEventInterface extends DomainEventInterface
{
    public function getIpCase(): IpCase;
}