<?php

namespace App\Services;

use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Facades\Http;

class ExampleService {
    /**
     * The function retrieves weather forecast data from the Open Meteo API based on latitude and
     * longitude coordinates.
     *
     * The result of an HTTP GET request to the Open Meteo API with the latitude and longitude
     * parameters provided, and including the current weather data.
     *
     * @param string $lat The latitude of the location
     * @param string $lon The "lon" parameter stands for longitude
     * @return array
     */
    public function getWeather(string $lat = '40.4165000', string $lon = '-3.7025600'): ClientResponse
    {
        return Http::get("https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true");
    }
}
