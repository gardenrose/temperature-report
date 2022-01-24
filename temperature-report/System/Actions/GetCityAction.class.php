<?php

//jedna od modifikacija koju je on trazio - radi

require("BaseAction.class.php");
require_once("./System/Util/DatabaseHelper.class.php");

use Actions\BaseAction;

class GetCityAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
    }

// provjera je li URL parametar city prazan, ako nije tj ako sadrzi neke podatke (grad)
// spremamo ih u varijablu koju proslijedimo u metodu za dohvaćanje grada
    public function execute()
    {
        if (isset($_GET['city'])) {
            $city = $_GET['city'];
             return DatabaseHelper::getCity($city);
        }
    }
}
