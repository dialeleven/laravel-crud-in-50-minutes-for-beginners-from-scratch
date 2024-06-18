<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Attribute\AsCommand;


#[AsCommand(name: 'process:queue')]
class ProcessQueue extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Redis queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        while (true) {
            $message = Redis::rpop('my_queue');
            if ($message) {
                $this->info("Processing: {$message}");
                // Process the message
            } else {
                sleep(1); // Avoid busy-waiting
            }
        }
    }
}
