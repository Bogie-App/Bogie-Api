<?php

namespace App\Dto;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "StationBriefDto",
    type: "object",
    required: ["id", "name"]
)]
class StationBriefDto
{
    #[OA\Property(type: "integer", example: 1)]
    public int $id;

    #[OA\Property(type: "string", example: "Station A")]
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}