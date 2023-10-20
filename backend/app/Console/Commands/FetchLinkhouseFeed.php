<?php

namespace App\Console\Commands;

use App\Services\LinkhouseFeedService;
use Illuminate\Console\Command;

class FetchLinkhouseFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:linkhouse-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches articles from linkhouse.pl/feed and updates database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $feedService = new LinkhouseFeedService();
        $feedService->updateFeed();
    }
}
