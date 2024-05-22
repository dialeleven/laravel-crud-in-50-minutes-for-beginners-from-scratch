<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WeatherAPI</title>
   @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
   <h1 class="text-3xl font-bold mt-8">
      Current Weather: {{ $weather_data->location->name . ', ' . $weather_data->location->region }}
   </h1>

   <div>
      Local time: {{$weather_data->location->localtime}}
   </div>

   @foreach ($weather_data->forecast->forecastday ?? [] as $forecast)
       <div class="bg-white shadow-md rounded-md p-6 mb-8 w-80">
           <h2 class="text-lg font-semibold mb-4">{{ $forecast->date ?? 'Date N/A' }}</h2>
           @if (isset($forecast->day))
               <div class="flex items-center justify-center mb-4">
                   <img src="{{ $forecast->day->condition->icon ?? 'Icon URL N/A' }}" alt="Weather Icon" class="w-16 h-16">
               </div>
               <p class="text-gray-700">{{ $weather_data->current->condition->text ?? 'Condition N/A' }}</p>
               <p class="text-gray-600 mt-2">Current Temp: {{ $weather_data->current->temp_c ?? 'N/A' }}°C</p>
               <p class="text-gray-600">
                  Current Wind: {{ $weather_data->current->wind_kph . ' ' . $weather_data->current->wind_dir ?? 'N/A' }} kph
               </p>
               <p class="text-gray-600">
                  Current Wind Gusts {{$weather_data->current->gust_kph}} kph
               </p>
               <p class="text-gray-600">Current Humidity: {{ $weather_data->current->humidity ?? 'N/A' }}%</p>
               <p class="text-gray-600 mt-2">Max Temp: {{ $forecast->day->maxtemp_c ?? 'N/A' }}°C</p>
               <p class="text-gray-600">Min Temp: {{ $forecast->day->mintemp_c ?? 'N/A' }}°C</p>
               <p class="text-gray-600">Humidity: {{ $forecast->day->avghumidity ?? 'N/A' }}%</p>
               <p class="text-gray-600">Wind: {{ $forecast->day->maxwind_kph ?? 'N/A' }} km/h</p>
           @else
               <p class="text-gray-600">No data available for this forecast.</p>
           @endif
       </div>
   @endforeach

<div class="mt-1">
   <a href="https://www.weatherapi.com/" title="Free Weather API" target="_blank"><img src='//cdn.weatherapi.com/v4/images/weatherapi_logo.png' alt="Weather data by WeatherAPI.com" border="0"></a>
</div>

<div class="m-3">
   Also check out <a href="https://www.weatherbit.io/" target="_blank" class="text-blue-600"> Weatherbit.io</a>.
</div>

</body>
</html>