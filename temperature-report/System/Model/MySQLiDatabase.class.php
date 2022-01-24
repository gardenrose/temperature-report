<?php

require("./System/Exceptions/DatabaseException.class.php");

class MySQLiDatabase
{
    public $MySQLiDatabase;

    protected $host, $user, $password, $database;

// parametri za povezivanje na bazu, postavljaju se u konstruktoru, potrebno je znati host (racunalo),
// korisnicko ime, lozinka i ime baze. kad se postave svi parametri, poziva se metoda za povezivanje, s tim parametrima
// a ta metoda kreira MySQLi instancu baze i vraca je, osim ako je doslo do greske u povezivanju, onda vraća gresku
// nakon povezivanja se kreirana instanca baze postavi za odabranu default bazu za upite i ostalo, metodom selectDatabase,
// proslijedi se kao parametar u već implementiranu php metodu select_db koja postavlja tu bazu kao defaultnu,
// ako se baza ne moze korisniti ili ne postoji i sl, ispisuje se poruka o gresci.
    public function __construct($host, $user, $password, $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->connectToDatabase();
        $this->selectDatabase();
    }

    public function connectToDatabase()
    {
        $this->MySQLiDatabase = new MySQLi($this->host, $this->user, $this->password);
        if (mysqli_connect_errno()) {
            throw new DatabaseException("Failed connecting to database: " . $this->database . "<br>");
        }
        return;
    }

    public function selectDatabase()
    {
        if ($this->MySQLiDatabase->select_db($this->database) === false) {
            throw new DatabaseException("Cannot use database " . $this->database, $this);
        }
    }

// za bilo koje upite nad bazom, ova metoda ce provest taj upit, to moze bit upit za sortiranje, prikaz
// nekih odredjenih podataka i sl, insert, brisanje, uredjivanje... kreira se query kao string
// npr "SELECT * FROM TEMPERATURES" , obicni sql upit, i proslijedi kao parametar php metodi query
// koja obavi sve na bazi, slanje upita i prikaz rezultata korisniku. ako je doslo do greske
// npr korisnicki upit nije valjan i pogresna je sintaksa upita, onda ispisuje gresku, inace vraca rezultat upita
    public function sendQuery($query, $errorReporting = true)
    {
        $this->result = $this->MySQLiDatabase->query($query);
        if ($this->result === false && $errorReporting === true) {
            throw new DatabaseException("Invalid SQL: " . $query . $this);
        }
        return $this->result;
    }
}
