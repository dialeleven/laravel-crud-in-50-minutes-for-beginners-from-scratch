<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Predis\Client;

use App\Jobs\EnqueueMessage;


class RedisAdminController extends Controller
{
    public function redis() {
        #Redis::set('key', 'value');
        
        $redis = app()->make('redis');
        $redis->set('foo', 'bar ' . date('Y-m-d H:i:s'));
        return $redis->get('foo');

    }


    public function storeArray() {
        $data = [
            'name' => 'Laravel',
            'version' => '11.x'
        ];

        Redis::set('frameworkdb', json_encode($data));

        $storedData = json_decode(Redis::get('frameworkdb'), true);

        return $storedData;
    }


    public function storeComplexArray() {
        // Retrieve existing data from Redis
        $storedData = json_decode(Redis::get('frameworks-arr'), true);
        

        // Check if the data exists, if not, initialize an empty array
        if (!$storedData) {
            $storedData = [];
        }

        // New or updated frameworks data
        $frameworksToAddOrUpdate = [
            [
                'name' => 'Laravel',
                'version' => '11.x',
                'release_date' => '2024-06-15'
            ],
            [
                'name' => 'Symfony',
                'version' => '6.x',
                'release_date' => '2023-12-01'
            ]
        ];

        foreach ($frameworksToAddOrUpdate as $newFramework) {
            $frameworkExists = false;
            foreach ($storedData as &$framework) {
                if ($framework['name'] == $newFramework['name']) {
                    // Update existing framework
                    $framework = array_merge($framework, $newFramework);
                    $frameworkExists = true;
                    break;
                }
            }

            // If the framework does not exist, add it to the array
            if (!$frameworkExists) {
                $storedData[] = $newFramework;
            }
        }

        // Encode the updated array back to JSON
        Redis::set('frameworks-arr', json_encode($storedData));

        // Retrieve and return the updated data
        $updatedData = json_decode(Redis::get('frameworks-arr'), true);

        return $updatedData;
    }


    // read
    public function set() {
        // Set a value
        Redis::set('name', 'LaravelXYZ');

        // Get a value
        $name = Redis::get('name');

        return $name;        
    }

    // create/update
    public function get()
    {
        $name = Redis::get('name');
        return 'Value: ' . $name;
    }

    public function update()
    {
        Redis::set('name', 'Laravel 9.x UPDATED VALUE');
        return 'Value updated';
    }

    public function delete()
    {
        Redis::del('name');
        return 'Value deleted';
    }

    public function hashSet()
    {
        Redis::hset('frameworks_hash', 'laravel', '9.x');
        Redis::hset('frameworks_hash', 'symfony', '5.4');
        return 'Hash values set';
    }

    public function hashGet()
    {
        $laravelVersion = Redis::hget('frameworks_hash', 'laravel');
        $symfonyVersion = Redis::hget('frameworks_hash', 'symfony');
        return "Laravel: $laravelVersion, Symfony: $symfonyVersion";
    }

    public function hashDelete()
    {
        Redis::hdel('frameworks_hash', 'laravel');
        return 'Laravel entry deleted';
    }

    
    public function storeAndRetrieveUsers()
    {
        // Example user data
        $users = [
            1 => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'age' => 30
            ],
            2 => [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'age' => 25
            ],
            3 => [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'age' => 28
            ]
        ];

        // Store user data in Redis using HSET
        foreach ($users as $userId => $userData) {
            foreach ($userData as $field => $value) {
                Redis::hset("user:$userId", $field, $value);
            }
        }

        // Retrieve all user data from Redis
        $retrievedUsers = [];
        foreach ($users as $userId => $userData) {
            $retrievedUsers[$userId] = Redis::hgetall("user:$userId");
        }

        // Return the retrieved user data as JSON
        return response()->json($retrievedUsers);
    }
}