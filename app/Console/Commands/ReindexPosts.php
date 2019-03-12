<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Elasticsearch\Client;
use App\Models\Post;

class ReindexPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:posts:rebuild';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindexes Posts';

    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param \Elasticsearch\Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all posts. Might take a while...');

        foreach (Post::cursor() as $post) {

            $this->client->index([
                'index' => $post->getSearchIndex(),
                'type' => $post->getSearchType(),
                'id' => $post->id,
                'body' => $post->toSearchArray(),
            ]);

            $this->output->write('.');
        }
        $this->info("\nDone!");
    }
}