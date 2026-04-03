<?php

namespace App\Dto;

use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "StationListResponseDto",
    type: "object",
    required: ["count", "stations", "status"]
)]
class StationListResponseDto
{
    #[OA\Property(type: "integer", example: 2)]
    public int $count;

    #[OA\Property(
        type: "array",
        items: new OA\Items(ref: new Model(type: StationBriefDto::class, groups: ['full']))
    )]
    public array $stations;

    #[OA\Property(type: "string", example: "success")]
    public string $status;

    public function __construct(int $count, array $stations, string $status)
    {
        $this->count = $count;
        $this->stations = $stations;
        $this->status = $status;
    }
}
