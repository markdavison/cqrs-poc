<?php


namespace App\MessageHandler;


    use App\Entity\Subject;
    use App\Message\SourceSubjectData;
    use App\Repository\IpCaseRepository;
    use App\Repository\SubjectRepository;
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
         * @var SubjectRepository
         */
        private $subjectRepository;

        /**
         * SourceSubjectDataHandler constructor.
         * @param EntityManagerInterface $entityManager
         * @param IpCaseRepository $ipCaseRepository
         * @param SubjectRepository $subjectRepository
         */
        public function __construct(
            EntityManagerInterface $entityManager,
            IpCaseRepository $ipCaseRepository,
            SubjectRepository $subjectRepository
        ) {
            $this->entityManager = $entityManager;
            $this->ipCaseRepository = $ipCaseRepository;
            $this->subjectRepository = $subjectRepository;
        }

        public function __invoke(SourceSubjectData $message)
        {
            $response = file_get_contents('http://host.docker.internal/mock/dataSourcingService');
            $data = json_decode($response, true);

            $ipCase = $this->ipCaseRepository->find($message->getIpCaseId());
            $subject = new Subject($ipCase, $data);

            $this->subjectRepository->save($subject);


        }
    }
