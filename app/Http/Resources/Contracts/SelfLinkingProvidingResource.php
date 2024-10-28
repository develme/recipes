<?php

namespace App\Http\Resources\Contracts;

use Illuminate\Http\Resources\Json\JsonResource;

interface SelfLinkingProvidingResource
{
    public function provideSelfLink(JsonResource $resource): string;
}
