<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MockDataSourcingServiceController extends AbstractController
{
    /**
     * @Route("/mock/dataSourcingService", name="mock_data_sourcing_service")
     */
    public function index()
    {
        sleep(30);
        return $this->json([
            'isDivisional' => false,
            'grantDate' => '2001-01-01',
            'applicationFilingDate' => '1999-12-25'
        ]);
    }
}
