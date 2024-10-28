<?php

namespace App\Console\Commands\Search;

use App\Models\Recipe;
use Illuminate\Console\Command;
use Solarium\Client;

class LoadRecipes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-recipes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run search indexing for recipes';

    /**
     * Execute the console command.
     */
    public function handle(Client $client)
    {
        $total = Recipe::count();
        $start = 0;

        $bar = $this->output->createProgressBar($total);

        while ($start < $total) {
            /** @var Recipe[] $recipes */
            $recipes = Recipe::with(['ingredients', 'steps' => function ($builder) {
                $builder->orderBy('order');
            }])->skip($start)->take(500)->get();

            $update = $client->createUpdate();

            foreach ($recipes as $recipe) {
                $doc = $update->createDocument();

                $data = $recipe->getIndexableData();

                if (!empty($data)) {
                    $doc->setFields($data);
                }

                $update->addDocument($doc);

                $bar->advance();
            }

            $update->addCommit();

            $client->update($update);

            $start += 500;
        }

        $bar->finish();
    }
}
