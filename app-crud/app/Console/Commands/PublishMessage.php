<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Attribute\AsCommand;


/*
Usage:

php artisan subscribe:channel (in one terminal)
php artisan publish:message "Hello, Redis!" (in another terminal - your message should appear in the other terminal)

php artisan process:queue (???)
*/

#[AsCommand(name: 'publish:message')]
class PublishMessage extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a message to Redis channel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $message = $this->argument('message');
        Redis::publish('my_channel', $message);
        $this->info('Message published!');
    }

    protected function configure()
    {
        $this->addArgument('message', null, 'Message to be published');
    }
}
