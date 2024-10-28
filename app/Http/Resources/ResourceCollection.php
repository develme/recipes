<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * This class standardizes Collection responses to be in the format:
 * {
 *    "data": [
 *       {
 *         "data": {}
 *         // Additional data here
 *      }
 *   ]
 * }
 *
 * This is useful for when you want to include additional data for individual resources in a collection.
 * Examples are the with data on non-collection Resource classes.
 */
abstract class ResourceCollection extends \Illuminate\Http\Resources\Json\ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($resource) use ($request) {
                $result = ['data' => $resource->resolve($request)];

                if ($resource instanceof Contracts\SelfLinkingProvidingResource) {
                    $result['links']['self'] = $resource->provideSelfLink($resource);
                }

                return $result;
            }),
        ];
    }
}
