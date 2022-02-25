<?php

namespace App\Repository;

class ReportRepository
{
    private array $lookup = [
        '$lookup' => [
            'from' => 'metrics',
            'localField' => 'accountId',
            'foreignField' => 'accountId',
            'as' => 'metrics',
        ]
    ];

    private array $group = [
        '$group' => [
            '_id' => '$_id',
            'accountName' => ['$first' => '$accountName'],
            'accountId' => ['$first' => '$accountId'],
            'spend' => ['$sum' => '$metrics.spend'],
            'clicks' => ['$sum' => '$metrics.clicks'],
            'impressions' => ['$sum' => '$metrics.impressions'],
            'costPerClick' => ['$sum' => '$metrics.costPerClick'],
        ]
    ];

    public function getReportsWithOutMetrics($collection, $match = []) {
        return $collection->aggregate([
            $this->lookup,
            ['$match' => [
                '$expr' => [
                    '$and' => [
                        ['$eq' => ['$metrics', []]],
                        ['$eq' => ['$status', 'ACTIVE']],
                        $match
                    ]
                ],
            ]],
            $this->group,
            ['$addFields' => [
                'costPerClicks' => 0,
            ]],
        ]);
    }

    public function getReportsWithMetrics($collection, $match = []) {
        return $collection->aggregate([
            $this->lookup,
            ['$unwind' => '$metrics'],
            ['$match' => [
                '$expr' => [
                    '$and' => [
                        ['$eq' => ['$status', 'ACTIVE']],
                        $match
                    ]
                ],
            ]],
            $this->group,
            ['$addFields' => [
                'costPerClicks' => ['$divide' => ['$costPerClick', '$clicks']],
            ]],
            ['$sort' => ['spend' => -1]],
        ]);
    }

    public function findReports($collection, ?string $accountId): array
    {
        if(!is_null($accountId)) {
            $report = $this->getReportsWithMetrics($collection, ['$eq' => ['$accountId', $accountId]])->toArray();

            if(count($report) <= 0) {
                $report = $this->getReportsWithOutMetrics($collection, ['$eq' => ['$accountId', $accountId]])->toArray();
            }

            return $report;
        }

        return $this->getAllReports($collection);
    }

    public function getAllReports($collection): array
    {
        return array_merge(
            $this->getReportsWithMetrics($collection)->toArray(),
            $this->getReportsWithOutMetrics($collection)->toArray()
        );
    }
}