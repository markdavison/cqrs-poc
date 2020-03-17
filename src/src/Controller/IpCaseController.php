<?php

namespace App\Controller;

use App\Entity\IpCase;
use App\Service\IpCaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Core principle: the controller is *ONLY* allowed to 
 * interact with a request, a response and a service.
 * 
 * Here we do tie ourselves to Symfony, but this seems acceptable
 * given the intended simplicity of the controller's role.
 *
 * The Route annotation could be removed in favour of a config file.
 */
class IpCaseController extends BaseController
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
