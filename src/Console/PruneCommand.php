<?php

namespace Jurager\Exchange\Console\Commands;

use Illuminate\Console\Command;
use Jurager\Exchange\Services\FileLoaderService;

class PruneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune old catalog uploads';

    /**
     * Execute the console command.
     *
     */
    public function handle(FileLoaderService $loaderService): void
    {
        $loaderService->clearImportDirectory();
    }
}