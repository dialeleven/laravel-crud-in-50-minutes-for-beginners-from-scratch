<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class WeatherApiController extends Controller
{
    public function index()
    {
        $api_key = '7ac761a1eb164e18aab182826242205';
        $url = 'https://api.weatherapi.com/v1/forecast.json';
        $query_string = "?key=$api_key&q=Toronto&aqi=yes";

        $response = Http::get($url . $query_string);
        /*
        $response = Http::post(
            "Your API",
            [
            'required_field' => $this->required_field,
            ]
            );
        */

        // Check if the request was successful (status code 2xx)
        if ($response->successful()) {
            // Get the response body as an array or JSON object
            #$data = $response->json();
            
            // Get raw response body
            $result = $response->getBody()->getContents();
            $weather_data = json_decode($result);

            if ($debug = 0)
            {
                echo "<pre><textarea cols='100' rows='10' style='font-size: 0.7rem;'>";
                print_r( $weather_data);
                echo "</textarea></pre>";
            }

            return view('public.weather.weatherapi', ['weather_data' => $weather_data]);
        } else {
            // Handle unsuccessful request
            $statusCode = $response->status();
            $errorMessage = $response->body();
            // Handle error
        }
    }
}
