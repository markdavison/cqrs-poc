<?php


namespace App\DomainEvent;


use App\Entity\IpCase;

class IpCaseCreated implements IpCaseEventInterface
{
    /**
     * @var IpCase
     */
    private $ipCase;

    /**
     * IpCaseCreated constructor.
     * @param IpCase $ipCase
     */
    public function __construct(IpCase $ipCase)
    {
        $this->ipCase = $ipCase;
    }

    /**
     * @return string
     */
    public function getIpCase(): IpCase
    {
        return $this->ipCase;
    }

}