<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Attribute\AsCommand;


#[AsCommand(name: 'subscribe:channel')]
class SubscribeToChannel extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to Redis channel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Redis::subscribe(['my_channel'], function ($message) {
            $this->info("Received message: {$message}");
        });
    }
}
