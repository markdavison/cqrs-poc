<?php


namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;


class CreateIpCaseCommand
{
    /**
     * @Assert\Uuid
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $ipNumber;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 2,
     *      minMessage = "The territoryCode should be {{ limit }} characters",
     *      maxMessage = "The territoryCode should be  {{ limit }} characters"
     * )
     * @var string
     */
    private $territoryCode;

    /**
     * @var string
     */
    private $caseReference;

    /**
     * CreateIpCaseCommand constructor.
     * @param string $id
     * @param string $ipNumber
     * @param string $territoryCode
     * @param string $caseReference
     */
    public function __construct(string $id, string $ipNumber, string $territoryCode, string $caseReference)
    {
        $this->id = $id;
        $this->ipNumber = $ipNumber;
        $this->territoryCode = $territoryCode;
        $this->caseReference = $caseReference;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
    public function getTerritoryCode(): string
    {
        return $this->territoryCode;
    }

    /**
     * @return string
     */
    public function getCaseReference(): string
    {
        return $this->caseReference;
    }

}