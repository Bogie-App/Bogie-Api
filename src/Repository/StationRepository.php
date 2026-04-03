<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;

class StationRepository
{
    public function __construct(
        private Connection $connection
    ) {}

    public function findAllStations(): array
    {
        return $this->connection->fetchAllAssociative(
            'SELECT id, name FROM stations'
        );
    }
}
