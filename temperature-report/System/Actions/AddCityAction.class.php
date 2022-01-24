<?php

require("BaseAction.class.php");
require_once("./System/Util/DatabaseHelper.class.php");

use Actions\BaseAction;

class AddCityAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
    }

// ide na putanju do URL parametra city, ako sadrzi podatke o gradu, spremi ih i proslijedi u metodu addCity
// koja je implementirana u klasi DatabaseHelper, provjeri output i ako je uspješan ispiše koji grad je dodan,
// ako ne, poruku o gresci
    public function execute()
    {
        if (isset($_GET['city'])) {
            $city = $_GET['city'];
            $isSuccess = DatabaseHelper::addCity($city);
            if ($isSuccess) {
                echo $city . " added.";
                echo ("<div><a href=\"/temperature-report\">Ok</a></div>");
            } else {
                echo ("Failed to add " . $city);
                echo ("<div><a href=\"/temperature-report\">Ok</a></div>");
            }
        }
    }
}
