<?php


namespace App\Query;


class FindIpCaseByIdQuery
{
    /**
     * @var string
     */
    private $ipCaseId;

    /**
     * FindIpCaseByIdQuery constructor.
     * @param string $caseId
     */
    public function __construct(string $ipCaseId)
    {
        $this->ipCaseId = $ipCaseId;
    }

    /**
     * @return string
     */
    public function getIpCaseId(): string
    {
        return $this->ipCaseId;
    }
}