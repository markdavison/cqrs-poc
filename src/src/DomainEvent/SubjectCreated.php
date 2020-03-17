<?php


namespace App\DomainEvent;


use App\Entity\IpCase;
use App\Entity\Subject;

class SubjectCreated implements IpCaseEventInterface
{
    /**
     * @var Subject
     */
    private $subject;

    /**
     * SubjectCreated constructor.
     * @param Subject $subject
     */
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    public function getIpCase() :IpCase
    {
        return $this->subject->getIpCase();
    }
}