<?php

namespace App\Services;

use MongoDB\Client;
use MongoDB\Collection;

trait MongoDBService
{
    protected Client $mongo;
    protected string $database;

    protected function connect($connection = 'mongodb://localhost:27017'): void
    {
        $this->mongo = new Client($connection);
    }

    protected function getCollection($collection): Collection
    {
        return $this->mongo->selectCollection($this->getDatabase(), $collection);
    }

    protected function getDatabase(): string
    {
        return $this->database;
    }

    protected function setDatabase($database): void
    {
        $this->database = $database;
    }
}