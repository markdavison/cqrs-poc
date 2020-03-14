<?php


namespace App\Message;


class SourceSubjectData
{
    /**
     * @var string
     */
    private $ipCaseId;

    /**
     * @var string
     */
    private $ipNumber;

    /**
     * @var string
     */
    private $territory;

    /**
     * SourceSubjectData constructor.
     * @param string $ipNumber
     * @param string $territory
     */
    public function __construct(string $ipCaseId, string $ipNumber, string $territory)
    {
        $this->ipCaseId = $ipCaseId;
        $this->ipNumber = $ipNumber;
        $this->territory = $territory;
    }

    /**
     * @return string
     */
    public function getIpCaseId(): string
    {
        return $this->ipCaseId;
    }

    /**
     * @return string
     */
    public function getIpNumber(): string
    {
        return $this->ipNumber;
    }

    /**
     * @return string
     */
    public function getTerritory(): string
    {
        return $this->territory;
    }


}
