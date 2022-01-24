<?php

// klasa showcitiesaction, nasljeđuje klasu baseaction i konstruktor od nje
// ima funkciju execute, koja vraca tj poziva metodu getCities iz klase DatabaseHelper
require("BaseAction.class.php");
require_once("./System/Util/DatabaseHelper.class.php");

use Actions\BaseAction;

class ShowCitiesAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute()
    {
        return DatabaseHelper::getCities();
    }
}
