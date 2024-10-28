<?php

namespace App\Repository;

use Illuminate\Contracts\Pagination\Paginator;
use App\Models\Recipe as RecipeModel;
use App\Search\Recipe as ReceiptSearch;
use Illuminate\Pagination\LengthAwarePaginator;

class Recipe
{
    public function __construct(private readonly ReceiptSearch $search)
    {
    }

    /**
     * @param string|null $search
     * @param int $perPage
     * @param int $page
     * @param array{ingredient: string, author: string} $filters
     * @return Paginator
     */
    public function search(?string $search, int $perPage = 15, int $page = 1, array $filters = []): Paginator
    {
        $result = $this->search->search($search, $perPage * ($page - 1), $perPage, $filters);

        /** @var string[] $slugs */
        $slugs = [];

        /** @var $documents */
        $documents = $result->getDocuments();

        foreach ($documents as $document) {
            $slugs[] = $document->slug;
        }

        $recipes = RecipeModel::with(['ingredients', 'steps' => function ($builder) {
            $builder->orderBy('order');
        }])->whereIn('slug', $slugs)->get();

        return new LengthAwarePaginator(
            $recipes,
            $result->getNumFound(),
            $perPage,
            $page, ['path' => LengthAwarePaginator::resolveCurrentPath(), 'pageName' => 'page']
        );
    }
}
