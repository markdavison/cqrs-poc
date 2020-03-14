<?php


namespace App\MessageHandler;


    use App\Entity\Subject;
    use App\Message\SourceSubjectData;
    use App\Repository\IpCaseRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

    class SourceSubjectDataHandler implements MessageHandlerInterface
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
         * SourceSubjectDataHandler constructor.
         * @param EntityManagerInterface $entityManager
         * @param IpCaseRepository $ipCaseRepositry
         */
        public function __construct(EntityManagerInterface $entityManager, IpCaseRepository $ipCaseRepositry)
        {
            $this->entityManager = $entityManager;
            $this->ipCaseRepository = $ipCaseRepositry;
        }


        public function __invoke(SourceSubjectData $message)
        {
            $response = file_get_contents('http://host.docker.internal/mock/dataSourcingService');
            $data = json_decode($response, true);

            $ipCase = $this->ipCaseRepository->find($message->getIpCaseId());
            $subject = new Subject($ipCase, $data);
            $this->entityManager->persist($subject);
            $this->entityManager->flush();
        }
    }
