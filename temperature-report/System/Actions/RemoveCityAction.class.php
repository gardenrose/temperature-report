<?php

// ukljucivanje datoteka, require_once provjerava je li datoteka vec ukljucena
// i ako je, ne ukljucuje je ponovno
require("BaseAction.class.php");
require_once("./System/Util/DatabaseHelper.class.php");

use Actions\BaseAction;

// klasa za uklanjanje gradova, nasljeđuje baznu klasu baseAction koju nasljeđuju sve klase za akcije
// u konstruktoru se poziva konstruktor bazne klase
class RemoveCityAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
    }

// provjera URL parametra city, sadrzi li podatke ili je empty, ako sadrzi
// podatke, kreiramo varijablu city i spremamo dohvaćenu vrijednost
// pozivamo removeCity i rezultat je boolean (true/false), sprema se u varijablu isSuccess
// ako je true, ispisujemo ime grada i removed, da je grad uklonjen.
// inace je doslo do greske i ispisujemo poruku o gresci, i komponentu ok, 
// kad se na nju klikne idemo na link za glavnu stranicu (homepage) 
    public function execute()
    {
        if (isset($_GET['city'])) {
            $city = $_GET['city'];
            $isSuccess = DatabaseHelper::removeCity($city);
            if ($isSuccess) {
                echo $city . " removed.";
                echo ("<div><a href=\"/temperature-report\">Ok</a></div>");
            } else {
                echo ("Failed to remove " . $city);
                echo ("<div><a href=\"/temperature-report\">Ok</a></div>");
            }
        }
    }
}
