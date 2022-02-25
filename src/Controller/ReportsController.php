<?php

namespace App\Controller;

use App\Repository\ReportRepository;
use App\Services\MongoDBService;
use MongoDB\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportsController extends AbstractController
{
    use MongoDBService;

    private ReportRepository $reportRepository;

    public function __construct()
    {
        // Inject from MongoDBService
        $this->connect();
        $this->setDatabase('demo-db');

        $this->reportRepository = new ReportRepository();
    }

    #[Route('/reports', name: 'reports_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $accounts = $this->getCollection('accounts');
        $accountId = $request->query->get('accountId');
        $reports = $this->reportRepository->findReports($accounts, $accountId);

        return $this->render('reports/index.html.twig', [
            'controller_name' => 'ReportsController',
            'reports' => $reports,
        ]);
    }
}
