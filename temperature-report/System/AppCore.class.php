<?php
require('core.functions.php');
require('Util/RequestHandler.class.php');
require('Exceptions/SystemException.class.php');

class AppCore
{
    protected static $dbObj;

    public function __construct()
    {
        $this->initDB();
        $this->initOptions();
        RequestHandler::handle();
    }

    public static function handleException($e)
    {
        try {
            $e->show();
        } catch (Exception $e2) {
            print("Cant catch exception.");
        } catch (Error $e3) {
            print($e3);
        }
    }
	
	//kreiranje instance baze s podacima za povezivanje, a ovi podaci su postavljeni u config.inc.php
	// korisnik je root, adresa je localhost, nema lozinke i baza je tmperature-report, kreirana instanca se spremi u var dbObj

    public function initDB()
    {
        require('./System/config.inc.php');
        require('./System/Model/MySQLiDatabase.class.php');

        self::$dbObj = new MySQLiDatabase($host, $user, $password, $database);
    }

// dohvaca bazu tj var dbObj, postavlja se jedino metodom initDB, u konstruktoru se ne postavlja i ako se ne 
// pozove metoda initDB, varijabla je prazna
    public static final function getDB()
    {
        return self::$dbObj;
    }

// postavlja adresu na kojoj pristupamo podacima, a to je localhost
    public function initOptions()
    {
        require('./System/options.inc.php');
    }
}
