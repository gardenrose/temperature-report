<?php

namespace Actions;

class BaseAction
{
	//konstruktor, poziva member metodu execute, i sprema rezultat u varijablu obj
	// ako obj var nije prazna, tj ako postoji onda se poziva metoda display kojoj
	// se kao parametar proslijedi obj, a ta metoda samo podatke predstavi u json formatu.
    public function __construct()
    {
        $obj = $this->execute();

        if (!empty($obj)) {
            $this->display($obj);
        }
    }
    public function execute()
    {
    }

    public function display($obj)
    {
        echo json_encode($obj);
    }
}
