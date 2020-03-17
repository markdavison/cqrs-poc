<?php

namespace App\Controller;

use App\Entity\IpCase;
use App\Service\IpCaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IpCaseController extends AbstractController
{
    /**
     * @Route("/ipCase", name="create-ip_case", methods={"POST"})
     */
    public function createCase(Request $request, IpCaseService $ipCaseService)
    {
        $ipCase = $ipCaseService->createIpCase(
            $request->get('ipNumber'),
            $request->get('territoryCode'),
            $request->get('caseReference')
        );

        return $this->json($ipCase);
    }

    /**
     * @Route("/ipCase/{id}", name="get-ip_case", methods={"GET"})
     */
    public function getCase(string $id, IpCaseService $ipCaseService)
    {
        $ipCase = $ipCaseService->getIpCaseById($id);
        return $this->json($ipCase);
    }
}
