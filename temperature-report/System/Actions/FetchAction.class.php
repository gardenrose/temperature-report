<?php

require("./System/Actions/BaseAction.class.php");
require_once("./System/Util/FetchApi.class.php");

use Actions\BaseAction;

class FetchAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute()
    {
        FetchApi::fetchData();
        echo "Data refreshed";
        echo ("<div><a href=\"/temperature-report\">Ok</a></div>");
    }
}
