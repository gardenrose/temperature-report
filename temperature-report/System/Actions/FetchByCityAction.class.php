<?php

//jedna od modifikacija koju je trazio ali ne radi (bilo je kompleksno i api ne radi kako treba)

require("./System/Actions/BaseAction.class.php");
require_once("./System/Util/FetchApi.class.php");

use Actions\BaseAction;

class FetchByCityAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
    }

	// poziva se metoda koja je implementirana u FetchApi klasi, metoda fetchByCity, kojoj se proslijedi odabrani grad kao parametar
	// i onda metoda vrati podatke o tom gradu.
    public function execute()
    {
        if (isset($_GET['city'])) {
            $city = $_GET['city'];
            FetchApi::fetchByCity(isset($_GET['city']));
        }

    }
}
