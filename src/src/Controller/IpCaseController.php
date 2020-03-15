<?php

namespace App\Controller;

use App\Command\CreateIpCaseCommand;
use App\Entity\IpCase;
use App\Message\SourceSubjectData;
use App\Query\FindIpCaseByIdQuery;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IpCaseController extends AbstractController
{
    /**
     * @Route("/ipCase", name="create-ip_case", methods={"POST"})
     */
    public function createCase(Request $request, MessageBusInterface $commandBus)
    {
        $id = Uuid::uuid4();

        $commandBus->dispatch(
            new CreateIpCaseCommand(
                $id,
                $request->get('ipNumber'),
                $request->get('territoryCode'),
                $request->get('caseReference')
            )
        );

        return $this->redirect(
            $this->generateUrl(
                'get-ip_case',
                ['id' => $id]
            )
        );
    }

    /**
     * @Route("/ipCase/{id}", name="get-ip_case", methods={"GET"})
     */
    public function getCase(string $id, MessageBusInterface $queryBus)
    {
        $envelope = $queryBus->dispatch(new FindIpCaseByIdQuery($id));

        $handledStamp = $envelope->last(HandledStamp::class);
        $result = $handledStamp->getResult();

        return $this->json($result);
    }
}
