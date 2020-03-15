<?php

namespace App\Controller;

use App\Entity\IpCase;
use App\Message\SourceSubjectData;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IpCaseController extends AbstractController
{
    /**
     * @Route("/ipCase", name="create-ip_case", methods={"POST"})
     */
    public function createCase(Request $request, EntityManagerInterface $em, MessageBusInterface $eventBus)
    {
        $id = Uuid::uuid4();

        $ipCase = new IpCase(
            $id,
            $request->get('ipNumber'),
            $request->get('territoryCode'),
            $request->get('caseReference')
        );

        $em->persist($ipCase);

        foreach ($ipCase->popEvents() as $event) {
            $eventBus->dispatch($event);
        }

        $em->flush();

        return $this->json($ipCase);
    }

    /**
     * @Route("/ipCase/{id}", name="get-ip_case", methods={"GET"})
     */
    public function getCase(IpCase $ipCase)
    {
        return $this->json($ipCase);
    }
}
