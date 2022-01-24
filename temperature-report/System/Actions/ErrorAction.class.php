<?php

require("BaseAction.class.php");

use Actions\BaseAction;

// akcija koja ispisuje poruku o gresci, poziva se u slucaju kad se neki podaci ne mogu dohvatiti
// ili ako neka metoda vrati false
class ErrorAction extends BaseAction
{
    public function code()
    {
        echo ("Error");
    }
}
