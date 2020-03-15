<?php


namespace App\CommandHandler;

    use App\Entity\Subject;
    use App\Command\SourceSubjectDataCommand;
    use App\Repository\IpCaseRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

    class SourceSubjectDataCommandHandler implements MessageHandlerInterface
    {
        /**
         * @var EntityManagerInterface
         */
        private $entityManager;

        /**
         * @var IpCaseRepository
         */
        private $ipCaseRepository;

        /**
         * SourceSubjectDataCommandHandler constructor.
         * @param EntityManagerInterface $entityManager
         * @param IpCaseRepository $ipCaseRepositry
         */
        public function __construct(EntityManagerInterface $entityManager, IpCaseRepository $ipCaseRepositry)
        {
            $this->entityManager = $entityManager;
            $this->ipCaseRepository = $ipCaseRepositry;
        }

        public function __invoke(SourceSubjectDataCommand $command)
        {
            $response = file_get_contents('http://host.docker.internal/mock/dataSourcingService');
            $data = json_decode($response, true);

            $ipCase = $this->ipCaseRepository->find($command->getIpCaseId());
            $subject = new Subject($ipCase, $data);
            $this->entityManager->persist($subject);
            $this->entityManager->flush();
        }
    }
