<?php

namespace App\Search;

use Solarium\QueryType\Select\Result\Result;

abstract class Search
{
    /**
     * Fields to be returned in the search results
     *
     * @var array{string}
     */
    protected const FIELDS = [];

    /**
     * Index is the field name
     * Value is the boost value
     *
     * @var array{string: string}
     */
    protected const QUERY_FIELDS = [];

    protected function getQueryFields(): string
    {
        $queryFields = [];

        foreach (static::QUERY_FIELDS as $field => $boost) {
            $queryFields[] = implode('^', [$field, $boost]);
        }

        return implode(' ', $queryFields);
    }

    protected function getFields(): array
    {
        return static::FIELDS;
    }


    /**
     * @param string $query
     * @param $start
     * @param $perPage
     * @param array{ingredient: string, author: string} $filters
     * @return Result
     */
    abstract public function search(string $query, int $start = 0, int $perPage = 10, array $filters = []): Result;
}
