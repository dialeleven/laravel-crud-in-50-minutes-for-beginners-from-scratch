<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Predis\Client;

class RedisAdminController extends Controller
{
    public function redis() {
        #Redis::set('key', 'value');
        
        $redis = app()->make('redis');
        $redis->set('foo', 'bar');
        return $redis->get('foo');

    }


    public function storeArray() {
        $data = [
            'name' => 'Laravel',
            'version' => '11.x'
        ];

        Redis::set('framework', json_encode($data));

        $storedData = json_decode(Redis::get('framework'), true);

        return $storedData;
    }


    public function storeComplexArray() {
        // Retrieve existing data from Redis
        $storedData = json_decode(Redis::get('frameworks'), true);

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
        Redis::set('frameworks', json_encode($storedData));

        // Retrieve and return the updated data
        $updatedData = json_decode(Redis::get('frameworks'), true);

        return $updatedData;
    }


    // read
    public function set() {
        // Set a value
        Redis::set('name', 'Laravel');

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
        Redis::set('name', 'Laravel 9.x');
        return 'Value updated';
    }

    public function delete()
    {
        Redis::del('name');
        return 'Value deleted';
    }

    public function hashSet()
    {
        Redis::hset('frameworks', 'laravel', '9.x');
        Redis::hset('frameworks', 'symfony', '5.4');
        return 'Hash values set';
    }

    public function hashGet()
    {
        $laravelVersion = Redis::hget('frameworks', 'laravel');
        $symfonyVersion = Redis::hget('frameworks', 'symfony');
        return "Laravel: $laravelVersion, Symfony: $symfonyVersion";
    }

    public function hashDelete()
    {
        Redis::hdel('frameworks', 'laravel');
        return 'Laravel entry deleted';
    }
}
