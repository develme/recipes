<?php

namespace App\Search;

use Solarium\Client;
use Solarium\QueryType\Select\Result\Result;

class Recipe extends Search
{
    /**
     * Fields to be returned in the search results
     *
     * @var array{string}
     */
    protected const FIELDS = ['slug'];

    /**
     * Index is the field name
     * Value is the boost value
     *
     * @var array{string: string}
     */
    protected const QUERY_FIELDS = [
        'slug' => '2.0',
        'name' => '1.5',
        'description' => '1.0',
        'ingredient_name' => '1.5',
        'step_name' => '1.5',
    ];

    public function __construct(protected readonly Client $client)
    {
    }

    /**
     * @param string $query
     * @param $start
     * @param $perPage
     * @param array{ingredient: string, author: string} $filters
     * @return Result
     */
    public function search(?string $query, $start = 0, $perPage = 10, array $filters = []): Result
    {
        $select = $this->client->createSelect();

        $edisMax = $select->getEDisMax();

        $edisMax->setQueryFields($this->getQueryFields());
        $select->setFields($this->getFields());

        $select->setQueryDefaultOperator($select::QUERY_OPERATOR_AND);
        $select->setStart($start);
        $select->setRows($perPage);
        $select->addSort('created_at', $select::SORT_DESC);

        $select->setQuery($query ?: '*');

        if (!empty($filters['ingredient'])) {
            $select->createFilterQuery('ingredient')->setQuery('ingredient_name:"' . $filters['ingredient'] . '"');
        }

        if (!empty($filters['author'])) {
            $select->createFilterQuery('email')->setQuery('email:"' . $filters['author'] . '"');
        }

        return $this->client->select($select);

    }
}
