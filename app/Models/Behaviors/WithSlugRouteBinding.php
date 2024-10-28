<?php

namespace App\Models\Behaviors;

trait WithSlugRouteBinding
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
