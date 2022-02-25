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

        // All accounts with metrics
        $reports = $accounts->aggregate([
            ['$lookup' => [
                'from' => 'metrics',
                'localField' => 'accountId',
                'foreignField' => 'accountId',
                'as' => 'metrics',
            ]],
            ['$unwind' => '$metrics'],
            ['$group' => [
                '_id' => '$_id',
                'accountName' => ['$first' => '$accountName'],
                'accountId' => ['$first' => '$accountId'],
                'spend' => ['$sum' => '$metrics.spend'],
                'clicks' => ['$sum' => '$metrics.clicks'],
                'impressions' => ['$sum' => '$metrics.impressions'],
                'costPerClicks' => ['$avg' => '$metrics.costPerClick'],
            ]],
            ['$sort' => ['spend' => -1]],
        ]);

        return $this->render('reports/index.html.twig', [
            'reports' => $reports->toArray(),
        ]);
    }
}
