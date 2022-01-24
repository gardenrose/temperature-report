<?php

// ukljucene datoteke i uvoz bazne klase
require("BaseAction.class.php");

use Actions\BaseAction;

class IndexAction extends BaseAction
{
	// metoda code ispisuje poruku o homepageu
    public function code()
    {
        echo ("This is the Home Page.");
    }
}
