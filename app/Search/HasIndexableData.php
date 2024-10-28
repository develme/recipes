<?php

namespace App\Search;

interface HasIndexableData
{
    public function getIndexableData(): array;
}
