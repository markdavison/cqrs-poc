<?php


namespace App\Service;


use App\Entity\IpCase;
use App\Repository\IpCaseRepository;

/**
 * Core principle: Repository interface has no third-party dependencies.
 * Any other dependencies are injected through the constructor.
 */
class IpCaseService
{

    /**
     * @var IpCaseRepository
     */
    private $ipCaseRepository;

    /**
     * IpCaseService constructor.
     * @param IpCaseRepository $ipCaseRepository
     */
    public function __construct(IpCaseRepository $ipCaseRepository)
    {
        $this->ipCaseRepository = $ipCaseRepository;
    }

    public function createIpCase(string $ipNumber, string $territoryCode, string $caseReference) :IpCase
    {
        $ipCase = new IpCase($ipNumber, $territoryCode, $caseReference);

        //Validation happens here by passing the entity into the validator

        $this->ipCaseRepository->save($ipCase);

        return $ipCase;
    }

    public function getIpCaseById(string $id)
    {
        return $this->ipCaseRepository->find($id);
    }
}