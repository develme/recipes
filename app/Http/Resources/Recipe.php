<?php

namespace App\Http\Resources;

use App\Http\Resources\Contracts\SelfLinkingProvidingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Recipe extends JsonResource implements SelfLinkingProvidingResource
{
    public function with(Request $request): array
    {
        return [
            'links' => [
                'self' => $this->provideSelfLink($this),
                'list' => route('api.v1.recipe.list'),
            ],
        ];
    }

    public function provideSelfLink(JsonResource $resource): string
    {
        return route('api.v1.recipe.show', ['recipe' => $resource->slug]);
    }
}
