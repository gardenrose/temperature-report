<?php

//stranica za dizajn i prikaz podataka o gradovima i tempraturama, sadrzi i podatke o serveru i metodu handle
// koja je implementirana da obavlja akcije koje korisnik izvodi, dodavanje, brisanje, uredjivanje i pregled
// gradova, temp itd
require_once('./System/Util/RequestHandler.class.php');
require_once("./System/Util/DatabaseHelper.class.php");

class IndexPage
{
    public $lastRefresh;
    
    public function __construct()
    {
        echo ("<script>function handle() {}</script>");
        
        echo ("Welcome to the Temperature Report.");
        echo ("<h1>Temperatures for cities:</h1>");

        // Search addition
        //echo ("<div style='margin: 5px;'><form action='search_name' method='post'><input type='submit' name='add' value='Search by name'><input type='text' placeholder='Enter the name of the city to search' style='width: 250px; margin-left: 5px;'></form></div>");
        //echo ("<div style='margin: 5px; margin-bottom: 30px;'><form action='Search_country' method='post'><input type='submit' name='remove' value='Search by country'><input type='text' placeholder='Enter the name of the country to search' style='width: 250px; margin-left: 5px;'></form></div>");
        
        $cities = DatabaseHelper::getAllTemperatures();
        $lastRefresh = "2021-09-13 22:12 GMT+2";

        if (empty($cities)) {
            echo ("No cities in database. Add a city to get the weather information.");
        } else {
            echo ("<table style='border-collapse: collapse; text-align: center; margin-left: 5px; margin-bottom: 30px;'><thead><th style='border: black solid 1px; padding: 5px;'>City</th><th style='border: black solid 1px; padding: 5px;'>Temperature</th></thead>");
            foreach ($cities as $city) {
                echo ("<tr><td style='border: black solid 1px; padding: 5px;'>" . $city["cityName"] . "</td><td style='border: black solid 1px; padding: 5px;'>" . $city["lastTemperature"] . "°C" . "</td></tr>");
            }
            echo ("</table>");
        }

        echo ("<div style='margin: 5px; margin-bottom: 30px;'>Last refresh: $lastRefresh (automatic refresh every 30 minutes)</div>");
        echo ("<div style='margin: 5px;'><form action=");
        echo $_SERVER['PHP_SELF'];
        echo(" method='get'><input type='submit' name='action' value='AddCity'><input type='text' name='city' placeholder='Enter the name of the city to add' style='width: 250px; margin-left: 5px;'></form></div>");
        echo ("<div style='margin: 5px;'><form action=");
        echo $_SERVER['PHP_SELF'];
        echo(" method='get'><input type='submit' name='action' value='RemoveCity'><input type='text' name='city' placeholder='Enter the name of the city to remove' style='width: 250px; margin-left: 5px;'></form></div>");
        echo ("<div style='margin: 5px;'><form action=");
        echo $_SERVER['PHP_SELF'];
        echo(" method='get'><input type='submit' name='action' value='Fetch'> Press to refresh the data</form></div>");
        
        if (array_key_exists('action', $_GET)) {
            RequestHandler::handle();
        }
           
    }
}
