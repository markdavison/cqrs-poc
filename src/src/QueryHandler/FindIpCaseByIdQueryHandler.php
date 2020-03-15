<?php


namespace App\QueryHandler;


use App\Command\SourceSubjectDataCommand;
use App\Entity\Subject;
use App\Query\FindIpCaseByIdQuery;
use App\Repository\IpCaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FindIpCaseByIdQueryHandler implements MessageHandlerInterface
{

    /**
     * @var IpCaseRepository
     */
    private $ipCaseRepository;

    /**
     * FindIpCaseByIdQueryHandlerimplements constructor.
     * @param IpCaseRepository $ipCaseRepositry
     */
    public function __construct(IpCaseRepository $ipCaseRepositry)
    {
        $this->ipCaseRepository = $ipCaseRepositry;
    }

    public function __invoke(FindIpCaseByIdQuery $query)
    {
        return $this->ipCaseRepository->find($query->getIpCaseId());
    }
}
