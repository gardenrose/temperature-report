<?php

require("BaseAction.class.php");
require_once("./System/Util/DatabaseHelper.class.php");
require_once("./System/Util/FetchApi.class.php");

use Actions\BaseAction;

class DisplayAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
    }

// isto kao  i za gradove, dohvaća podatke o temperaturi, provjerava URL parametar temperature
// ako nije prazan, tj ako sadrži neku temperaturu, onda je proslijedi u metodu fetchTemperature
// koja prikazuje podatke o toj temperaturi , ako ne postoji onda dohvaća sve dostupne temprature
    public function execute()
    {
        if (isset($_GET['temperature'])) {
            return FetchApi::fetchTemperature($_GET['temperature']);
        } else {
            return DatabaseHelper::getAllTemperatures();
        }
    }
}
