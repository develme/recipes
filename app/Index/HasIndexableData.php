<?php

namespace App\Index;

interface HasIndexableData
{
    public function getIndexableData(): array;
}
