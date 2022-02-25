<?php

namespace App\Controller;

use MongoDB\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportsController extends AbstractController
{
    #[Route('/reports', name: 'reports_index', methods: ['GET'])]
    public function index(): Response
    {
        $client = new Client();
        $accounts = $client->selectCollection('demo-db', 'accounts');
        $metrics = $client->selectCollection('demo-db', 'metrics');

        // Use Lookup the metrics by account ID
        $metricsByAccount = $metrics->aggregate([
            ['$lookup' => [
                'from' => 'accounts',
                'localField' => 'accountId',
                'foreignField' => 'accountId',
                'as' => 'account',
            ]],
            ['$unwind' => '$account'],
            ['$group' => [
                '_id' => '$accountId',
                'costPerClick' => ['$avg' => '$costPerClick'],

            ]],
        ]);

        $reports = $accounts->find(['status' => 'ACTIVE'])->toArray();

        return $this->render('reports/index.html.twig', [
            'reports' => $reports,
        ]);
    }
}
