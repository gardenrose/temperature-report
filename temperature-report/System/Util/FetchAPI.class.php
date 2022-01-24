<?php

require_once('./System/Util/DatabaseHelper.class.php');

class FetchApi
{
	// podaci o serveru
    private static $baseApiEndpoint = "https://api.openweathermap.org/data/2.5/weather?q=";
    private static $API_key = "6bfc891f5b46198a49cd002b8fed4a45";
	// postavlja putanje do gradova, za svaki doda API key sifru na kraj URL-a
	// i poziva getData metodu, koja podatke u json formatu pretvara u php varijable.
	
    public static function fetchData()
    {
        $cities = DatabaseHelper::getCities();
        foreach ($cities as $city) {
            $apiEndpoint = self::$baseApiEndpoint . $city["cityName"] . "&appid=" . self::$API_key;
            $response = self::getData($apiEndpoint);
            var_dump($response);
            echo("<br>");
            $cityData = array($response->id, $city["cityName"], $response->main->temp - 273.15);
            DatabaseHelper::updateTemperatureAndId($cityData);
        }
        
    }
	
	//dohvaća podatke o nekoj temperaturi sa servera, u formatu gdje ide api endpoint (sadrzi ime grada), icao24 je format adrese, zatim ide
	// temperatura, koju smo poslali kao parametar, i time 0
	// poziva se getdata metoda koja dohvaca te podatke u json obliku i prevodi ih u php var.
	// kao output se vraca putanja do rezultata, tj adresa.

    public static function fetchTemperature($temperature)
    {
        $apiEndpoint = self::$baseApiEndpoint . "/tracks";
        $requestUrl = $apiEndpoint . "?icao24=" . $temperature . "&time=0";
        $response = self::getData($requestUrl);
        return $response["path"];
    }

// sa nekog url-a dohvati sve podatke, pre-made funkcija, i pretvara iz json formata u php
    private static function getData($url)
    {
        $json = file_get_contents($url);
        return json_decode($json);
    }

// za neki proslijedjeni grad vraca podatke o vremenu
// isto se salje putanja, tj proxy ("https://api.openweathermap.org/data/2.5/weather?q=") i doda se ime graada i api key
// na tu adresu da izdvoji samo podatke o tom gradu, iz podataka dohvaca vrijednost kljuca temp i spremi u varijablu
// weatherData koja je output
    public static function fetchByCity($city)
    {
        $apiEndpoint = self::$baseApiEndpoint . $city . "&appid=" . self::$API_key;
        $response = self::getData($apiEndpoint);
        $weatherData = $response->main->temp;
        
        return $weatherData;
    }
}
